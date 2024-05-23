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

const img = ref(null);
const isLoading = ref(false)

onMounted(() => {
  const imgEl = img.value

  isLoading.value = true
  fetch(`${site}/build/media/${props.media.mediaPath}`).then((r) => {
    if (r.ok) {
      imgEl.addEventListener('load', () => {
        emit('loaded');
        isLoading.value = false
      })
    }
  })
})
const site = window.location.origin;
const emit = defineEmits(['removed', 'loaded'])

const deleteMedia = async () => {
  if (confirm('Sure de vouloir supprimer ' + props.media.mediaPath + ' ?')) {
    await fetch(`${site}/media/${props.media.id}/delete`)
        .then((r) => {
          if (r.status === 200) {
            emit('removed', props.media.id);
          }
        })
  }

}

</script>

<template>
  <div v-if="!isLoading" class="position-relative">
    <div class="position-absolute top-0 start-0 p-2" v-if="buttons" style="z-index: 1050;">
      <Button icon-class-start="trash-fill" color-class="danger" round-class="pill" @click.prevent="deleteMedia"/>
    </div>
    <img
        :src="`${site}/build/media/${media.mediaPath}`"
        :alt="media.mediaPath"
        class="w-100 object-fit-cover rounded-4 freezeframe"
        :id="`media-${media.id}`"
        style="aspect-ratio: 1/1 !important;"
        ref="img"
    >
  </div>
  <LoadingSpinner v-else/>
</template>

<style scoped>

</style>