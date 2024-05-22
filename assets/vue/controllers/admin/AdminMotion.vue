<script setup>
const props = defineProps({
  media: {type: Object, required: true}
})

const site = window.location.origin;
</script>

<template>
<section class="row row-cols-4 my-4">
  <div v-for="(gif, index) in media" :key="index">
    <img :src="`${site}/build/media/motion/${gif.mediaPath}`" :alt="gif.mediaPath" class="w-100 object-fit-fill border rounded-4">
  </div>
</section>
</template>

<style scoped>

</style>