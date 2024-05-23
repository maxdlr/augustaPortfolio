<script setup>
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import {computed, onUpdated, ref, watch} from "vue";
import Freezeframe from "freezeframe";

const props = defineProps({
  medias: {type: Object, required: true},
  colCount: {type: [Number, String], default: 4, required: false},
  lazyLoadTrigger: {type: [String, Boolean], default: null, required: false, validator(value) {
      return ['hover', 'click', false].includes(value)
    }},
  buttons: {type: Boolean, required: false, default: false}
})

const tempRemovedMedia = ref([]);

const filteredMedias = computed(() => {
  const filteredMedias = [];
  for (const key in props.medias) {
    if (!tempRemovedMedia.value.includes(props.medias[key].id)) {
      filteredMedias.push(props.medias[key])
    }
  }
  return filteredMedias;
})



onUpdated(() => {
  console.log(tempRemovedMedia.value)
})
const blackList = (mediaId) => {
  tempRemovedMedia.value.push(mediaId)
}

const freezeFrame = () => {
  if (props.lazyLoadTrigger) {
    new Freezeframe({trigger: props.lazyLoadTrigger, warnings: true})
  }
}


</script>

<template>
  <section class="row my-4" :class="`row-cols-${colCount}`">
    <div v-for="(media, index) in filteredMedias" :key="index" class="p-1 position-relative">
      <MediaThumbnail
          :media="media"
          :buttons="buttons"
          @removed="blackList"
          @loaded="freezeFrame"
      >
      </MediaThumbnail>
    </div>

  </section>
</template>

<style scoped>

</style>