<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import MediaGallery from "../molecule/MediaGallery.vue";
import Avatar from "../molecule/Avatar.vue";

const props = defineProps({
  avatarImg: {type: Object, required: true}
})

const site = window.location.origin;

</script>

<template>
  <div id="illustration"></div>
<BaseTemplate>
  <template #context>
    <div>
    <Avatar :avatar-img="avatarImg" />
    <div class="fs-1">
      <div>
        <span class="text-secondary">A propos</span>
        <span class="text-info">.</span>
      </div>
      <div>
        <span class="text-info">Who </span>
        <span class="text-secondary">the hell </span>
        <span class="text-primary">am I?</span>
      </div>
    </div>
    </div>
  </template>
  <template #content>
  </template>
</BaseTemplate>
</template>

<style scoped>

</style>