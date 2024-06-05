<script setup>
import {onMounted, ref} from "vue";
import LoadingSpinner from "./LoadingSpinner.vue";
import Button from "../../controllers/components/Button.vue";
import {SLIDE_RIGHT} from "../../constant/animation";

const props = defineProps({
  media: {type: Object, required: false},
  buttons: {type: Boolean, required: false, default: false},
  hoverAction: {type: Boolean, default: false, required: false},
  animate: {type: Boolean, default: true, required: false}
})

const imgRef = ref(null);
const img = ref();
const isLoading = ref(false)
const loadedSrc = ref()
const site = window.location.origin;
const emit = defineEmits(['delete', 'loaded', 'show'])

const fetchMedia = async () => {
  let responseStatus = 0;
  await fetch(`${site}/build/media/${props.media.mediaPath}`)
      .then(response => {
        responseStatus = response.status
      })
  return responseStatus === 200
}

const setMediaSrc = async (e) => {
  isLoading.value = true

  const isMediaFetched = props.media ? await fetchMedia() : false;

  if (isMediaFetched) {
    loadedSrc.value = `${site}/build/media/${props.media.mediaPath}`
    e.src = loadedSrc.value;
    e.alt = props.media.mediaPath;
    e.addEventListener('load', () => {
      emit('loaded');
      isLoading.value = false
    })
  }
}

onMounted(async () => {
  img.value = imgRef.value

  const hash = Number(window.location.hash.replace('#media-', ''))

  if (props.media?.id === hash) {
    emit('show', props.media.id)
  }

  await setMediaSrc(imgRef.value)
})

const deleteMedia = async () => {
  if (confirm('Sure de vouloir supprimer ' + props.media.mediaPath + ' ?')) {
    await fetch(`${site}/media/${props.media.id}/delete`)
        .then(r => r.json().then(data => ({ok: r.ok, body: data}))
            .then(obj => {
              if (obj.ok) {
                console.log(obj.body.message);
                emit('delete', props.media.id);
              }
            }));
  }
}

const show = (id) => {
  emit('show', id)
}

</script>

<template>
  <TransitionGroup :name=" animate ? SLIDE_RIGHT : ''">
    <div
        v-if="!isLoading"
        :class="{'animate-stage-hover': hoverAction}"
        class="position-relative"
    >
      <div v-if="buttons" class="position-absolute top-0 start-0 p-2" style="z-index: 1050;">
        <Button color-class="danger" icon-class-start="trash-fill" round-class="pill" @click.prevent="deleteMedia"/>
      </div>

      <div
          :class="{'animate-stage-target': hoverAction}"
          class="rounded-4 overflow-hidden"
          @click.prevent="show(media.id)">
        <img
            v-if="media"
            :id="`mediaThumbnail-${media.id}`"
            ref="imgRef"
            :src="loadedSrc"
            class="w-100 object-fit-cover freezeframe"
            style="aspect-ratio: 1/1 !important;"
        >
      </div>
    </div>
  </TransitionGroup>
  <LoadingSpinner v-if="isLoading"/>
</template>

<style lang="scss" scoped>
@import '../../../styles/slide-right';
@import '../../../styles/animation';
@import "../../../styles/var-override";

.animate-stage-hover {
  & .animate-stage-target {
    background-color: transparent;
    z-index: 5;

    transition: all $duration $timing;

    img {
      transition: all $duration $timing;
    }
  }

  &:hover {
    & .animate-stage-target {
      background: $info;
      overflow: hidden;
      height: 100%;
      z-index: 2;

      img {
        opacity: 50%;
      }
    }
  }
}

</style>