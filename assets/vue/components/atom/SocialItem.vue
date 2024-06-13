<script setup>
import {ref} from "vue";

const props = defineProps({
  socialItem: {type: Object, required: true},
  size: {type: [String, Number], default: 50, required: false}
})

const socialColors = ref({
  instagram: '#DD2A7B',
  linkedin: '#0077B5',
  facebook: '#3B5998',
  'twitter-x': '#08a0e9',
  tiktok: '#00F2EA',
  pinterest: '#BD081C',
  discord: '#5865F2',
})

</script>

<template>
  <a
      :href="socialItem.link"
      :style="[
          `background-color: ${socialColors[socialItem.icon]} !important;`,
          `width: ${size}px !important;`
          ]"
      class="btn p-0 d-flex justify-content-center align-items-center rounded-circle cursor-pointer"
      style="aspect-ratio: 1/1 !important;"
  >
    <i :class="[
        `bi-${socialItem.icon}`,
        socialItem.icon === 'tiktok' ? '' : 'text-white'
        ]" class="bi fs-5"></i>
  </a>
</template>

<style lang="scss" scoped>

</style>