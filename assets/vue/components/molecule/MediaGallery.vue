<script setup>
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import {computed, onMounted, ref} from "vue";
import Freezeframe from "freezeframe";
import {Modal} from 'bootstrap';
import Button from "../../controllers/components/Button.vue";

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
  startMediaCount: {type: [String, Number], default: null, required: true}
})

const filteredMedias = ref({})
const shownImgRef = ref(null)
const shownImg = ref();
const site = window.location.origin;
const modalElRef = ref(null)
const modalEl = ref();

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
const emit = defineEmits(['allShown']);
const shownMediaCount = ref(0);
const isAllShown = computed(() => {
  return shownMediaCount.value === props.medias.length
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
      filteredMedias.value[props.medias[mediaKey].id] = props.medias[mediaKey]
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

const showImg = (id) => {
  if (!props.isOnMobile) {
    shownImg.value.src = `${site}/build/media/${filteredMedias.value[id].mediaPath}`
    shownImg.value.alt = `show image of ${filteredMedias.value[id].mediaPath}`
    if (!props.ignoreHash) window.location.hash = `#media-${id}`
    openModal(id)
  }
}

const openModal = (id) => {
  const modal = new Modal(modalEl.value)
  modal.show()

  if (!props.ignoreHash) {
    modalEl.value.addEventListener('hide.bs.modal', () => {
      window.location.hash = filteredMedias.value[id].type.toLowerCase()
    }, {once: true})
  }
}


</script>

<template>
  <section :class="`row-cols-lg-${colCount}`" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 my-4">
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
          @delete="deleteMedia"
          @loaded="freezeFrame"
          @show="showImg"
      />
    </div>
    <Button v-if="!isAllShown" icon-class-start="plus" label="more" @click.prevent="showAll"/>
    <Button v-else icon-class-start="minus" label="less" @click.prevent="showSix"/>
  </section>

  <div :id="`${galleryName}-mediaLightBox`" ref="modalElRef"
       :aria-labelledby="`${galleryName}-mediaLightBoxLabel`"
       aria-hidden="true" class="modal modal-xl fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered rounded-4 overflow-hidden" style="width: fit-content !important;">
      <div class="modal-content w-100 rounded-4 overflow-hidden">
        <div class="modal-body bg-dark text-center w-100 p-0 rounded-4 overflow-hidden">
          <img ref="shownImgRef" alt="" class="rounded-4" src=""
               style="max-width: 100% !important; max-height: 80vh !important;">
        </div>
      </div>
    </div>
  </div>

</template>

<style scoped>

</style>