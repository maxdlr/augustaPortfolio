<script setup>

import MediaThumbnail from "../../components/atom/MediaThumbnail.vue";

const props = defineProps({
  avatarImg: {type: Object}
})
</script>

<template>
  {{avatarImg}}
  <div style="width: 200px !important; aspect-ratio: 1/1 !important;" class="rounded-circle overflow-hidden">
    <MediaThumbnail :media="avatarImg" class="w-100"/>
  </div>
</template>

<style scoped>

</style>