<script setup>
const props = defineProps({
  medias: {type: Object, required: true}
})
const site = window.location.origin;

</script>

<template>
  <section class="row row-cols-4 my-4">
    <div v-for="(media, index) in medias" :key="index">
      <img :src="`${site}/build/media/${media.mediaPath}`" :alt="media.mediaPath" class="w-100 object-fit-fill border rounded-4">
    </div>
  </section>
</template>

<style scoped>

</style>