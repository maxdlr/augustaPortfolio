<script setup>
import {onMounted, ref} from "vue";
import LoadingSpinner from "./LoadingSpinner.vue";
import Freezeframe from "freezeframe";
import {onDOMContentLoaded} from "bootstrap/js/src/util";
import Button from "../../controllers/components/Button.vue";
import {goTo} from "../../composable/action/redirect";

const props = defineProps({
  media: {type: Object, required: true},
  lazyLoadTrigger: {type: [String, Boolean], default: null, required: false, validator(value) {
    return ['hover', 'click', false].includes(value)
    }},
  buttons: {type: Boolean, required: false, default: false}
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
  const isMediaFetched = await fetchMedia();

  if (isMediaFetched) {
    loadedSrc.value = `${site}/build/media/${props.media.mediaPath}`
    e.src = loadedSrc.value
    e.addEventListener('load', () => {
      emit('loaded');
      isLoading.value = false
    })
  }
}

onMounted(async () => {
  img.value = imgRef.value
  const hash = Number(window.location.hash.replace('#media-', ''))

  if (props.media.id === hash) {
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
  <div v-if="!isLoading" class="position-relative">
    <div class="position-absolute top-0 start-0 p-2" v-if="buttons" style="z-index: 1050;">
      <Button icon-class-start="trash-fill" color-class="danger" round-class="pill" @click.prevent="deleteMedia"/>
    </div>
    <div class="rounded-4 overflow-hidden" @click.prevent="show(media.id)">
      <img
          :src="loadedSrc"
          :alt="media.mediaPath"
          class="w-100 object-fit-cover freezeframe"
          :id="`media-${media.id}`"
          style="aspect-ratio: 1/1 !important;"
          ref="imgRef"
      >
    </div>
  </div>
  <LoadingSpinner v-else/>
</template>

<style scoped>

</style>