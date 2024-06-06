<script setup>
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import {computed, onMounted, ref} from "vue";
import Freezeframe from "freezeframe";
import {Modal} from 'bootstrap';
import Button from "../../controllers/components/Button.vue";
import {SLIDE_RIGHT} from "../../constant/animation";
import {useClipboard} from '@vueuse/core'

const currentHref = ref()
const {text, copy, copied, isSupported} = useClipboard({currentHref})


const props = defineProps({
  medias: {type: Object, required: true},
  colCount: {type: [Number, String], default: 4, required: false},
  lazyLoadTrigger: {
    type: [String, Boolean], default: null, required: false, validator(value) {
      return ['hover', 'click', false].includes(value)
    }
  },
  buttons: {type: Boolean, required: false, default: false},
  galleryName: {type: String, required: true},
  ignoreHash: {type: Boolean, required: false, default: false},
  isOnMobile: {type: Boolean, default: true, required: true},
  startMediaCount: {type: [String, Number], default: null, required: true},
  admin: {type: Boolean, default: false, required: false}
})

const filteredMedias = ref({})
const shownImgRef = ref(null)
const shownImg = ref();
const site = window.location.origin;
const modalElRef = ref(null)
const modalEl = ref();
const emit = defineEmits(['allShown']);
const shownMediaCount = ref(0);
const isAllShown = computed(() => {
  return shownMediaCount.value === props.medias.length
})
const loadedMediaCount = ref(0);
const isAllLoaded = ref(false);
const isModalOpen = ref(false)

onMounted(() => {
  shownImg.value = shownImgRef.value
  modalEl.value = modalElRef.value

  if (props.startMediaCount === 'all') {
    shownMediaCount.value = props.medias.length
  } else {
    shownMediaCount.value = Number(props.startMediaCount)
  }
  filter()
})

const showAll = () => {
  shownMediaCount.value = props.medias.length;
  emit('allShown');
  filter()
}
const showSix = () => {
  shownMediaCount.value = 6;
  emit('lessShown');
  filter()
}

const filter = () => {
  let i = 0;
  filteredMedias.value = {};
  for (const mediaKey in props.medias) {
    if (i < shownMediaCount.value) {
      filteredMedias.value[i] = props.medias[mediaKey]
    }
    i++
  }
}

const deleteMedia = (mediaId) => {
  delete filteredMedias.value[mediaId]
}

const freezeFrame = () => {
  if (props.lazyLoadTrigger) {
    new Freezeframe({trigger: props.lazyLoadTrigger, warnings: true})
  }
}

const handleOnLoaded = () => {
  loadedMediaCount.value++

  if (loadedMediaCount.value === Object.keys(filteredMedias.value).length) {
    freezeFrame()
    isAllLoaded.value = true;
  }
}
const showImg = (id) => {
  if (!props.isOnMobile) {
    setModalImg(id)
    openModal(id)
  }
}

const setModalImgLocationHash = (id) => {
  if (!props.ignoreHash) {
    window.location.hash = `#media-${id}`
  }
  focusShownImg()
}

const focusShownImg = () => {
  currentHref.value = window.location.href
  modalEl.value.focus()
}

const setModalImg = (id) => {
  const media = Object.entries(filteredMedias.value).filter((media) => {
    return media[1].id === id
  })[0][1]

  shownImg.value.src = `${site}/build/media/${media.mediaPath}`
  shownImg.value.alt = `show image of ${media.mediaPath}`
  shownImg.value.id = media.id;

  window.addEventListener('hashchange', focusShownImg)
}

const changeShownImg = (next) => {
  let nextMedia = {};
  let nextKey = 0;

  for (const key in filteredMedias.value) {
    if (filteredMedias.value[key].id === Number(shownImg.value.id)) {
      nextKey = next ? Number(key) + 1 : Number(key) - 1

      if (Number(key) + 1 === Object.keys(filteredMedias.value).length && next) {
        nextKey = 0
      } else if (Number(key) === 0 && !next) {
        nextKey = Object.keys(filteredMedias.value).length - 1
      }

      nextMedia = filteredMedias.value[nextKey]
    }
  }
  if (nextMedia) {
    setModalImg(nextMedia.id)
    setModalImgLocationHash(nextMedia.id)
  }
  focusShownImg()
}

const openModal = (id) => {
  setModalImgLocationHash(id)
  const modal = new Modal(modalEl.value)
  modal.show()
  isModalOpen.value = true

  modalEl.value.addEventListener('hide.bs.modal', () => {
    if (!props.ignoreHash) window.location.hash = '/';
    isModalOpen.value = false

    window.removeEventListener('hashchange', focusShownImg)

  }, {once: true})
}


</script>

<template>
  <section>
    <div class="text-end">
      <Transition :name="SLIDE_RIGHT">
        <Button
            v-if="isAllShown && !admin"
            class="p-3"
            color-class="info"
            custom-pointer
            icon-class-start="dash-circle-fill"
            label="see less"
            size="sm"
            @click.prevent="showSix"
        />
      </Transition>
    </div>
    <div :class="`row-cols-lg-${colCount}`" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 my-4 position-relative">
      <div v-for="media in filteredMedias"
           :key="media.id"
           :data-bs-toggle="!isOnMobile ? 'modal' : ''"
           :type="!isOnMobile ? 'button' : ''"
           class="p-1 position-relative"
      >
        <MediaThumbnail
            :buttons="buttons"
            :hover-action="!isOnMobile"
            :media="media"
            class="eye-cursor"
            @delete="deleteMedia"
            @loaded="handleOnLoaded"
            @show="showImg"
        />
      </div>
      <div class="position-absolute bottom-0 end-0 p-3 text-end">
        <Transition :name="SLIDE_RIGHT">
          <Button
              v-if="!isAllShown && isAllLoaded && !admin"
              color-class="light"
              custom-pointer
              icon-class-start="plus-circle-fill"
              label="see more"
              @click.prevent="showAll"
          />
        </Transition>
      </div>
    </div>

  </section>


  <div :id="`${galleryName}-mediaLightBox`" ref="modalElRef"
       :aria-labelledby="`${galleryName}-mediaLightBoxLabel`"
       aria-hidden="true" class="modal modal-xl fade" tabindex="-1"
       @keydown.right="changeShownImg(true)" @keydown.left="changeShownImg(false)"
  >
    <div class="modal-dialog modal-fullscreen rounded-4">

      <div class="modal-content w-100 rounded-4 bg-transparent border-0">
        <div class="modal-header border-0 justify-content-center position-relative">
          <div class="text-center">
            <div>
              <Button
                  class="m-1"
                  color-class="primary"
                  custom-pointer
                  icon-class-end="arrow-left-circle-fill"
                  @click.prevent="changeShownImg(false)"
              />
              <Button
                  class="m-1"
                  color-class="primary"
                  icon-class-end="arrow-right-circle-fill"
                  @click.prevent="changeShownImg(true)"
              />
            </div>

            <div v-if="isSupported">
              <Button
                  :label="copied ? 'link copied!' : null"
                  animate="right"
                  class="m-1"
                  color-class="info"
                  custom-pointer
                  icon-class-start="copy"
                  @click.prevent="copy(currentHref)"
              />
            </div>
          </div>
          <Button
              class="position-absolute top-0 end-0 m-3"
              color-class="primary"
              custom-pointer
              data-bs-dismiss="modal"
              icon-class-end="x-circle-fill"
              size="lg"
          />
        </div>

        <div
            class="modal-body d-flex justify-content-center align-items-start bg-transparent text-center w-100 p-0 rounded-4 position-relative">

          <div class="position-absolute start-0 top-0 w-50 h-100 previous-cursor"
               role="button"
               @click.prevent="changeShownImg(false)"></div>
          <div class="position-absolute end-0 top-0 w-50 h-100 next-cursor"
               role="button"
               @click.prevent="changeShownImg(true)"></div>

          <img
              ref="shownImgRef"
              alt=""
              class="rounded-4"
              src=""
              style="max-width: 100% !important; max-height: 80vh !important;"
          >
        </div>
      </div>
    </div>
  </div>

</template>

<style lang="scss" scoped>
@import '../../../styles/slide-right';

.next-cursor {
  cursor: url("../../../../public/build/media/misc/arrow-right-cursor.png"), w-resize !important;
}

.previous-cursor {
  cursor: url("../../../../public/build/media/misc/arrow-left-cursor.png"), e-resize !important;
}

</style>