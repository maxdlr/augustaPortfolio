<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import Avatar from "../molecule/Avatar.vue";
import AboutSection from "../molecule/AboutSection.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import {onMounted} from "vue";

const props = defineProps({
  avatarImg: {type: Object, required: false},
  anchor: {type: String, required: true},
  interventions: {type: Object},
  experiences: {type: Object},
  skills: {type: Object},
  meuf: {type: Object}
})

</script>

<template>
  <BaseTemplate
      :anchor="anchor"
      :cols="[4, 8]"
      :content-flex="{justify: {md: 'center'}, align: {md: 'start'}}"
      :context-flex="{justify: {md: 'center'}, align: {md: 'start'}}"
  >
    <template #context="{screenWidth, screenHeight}">
      <div class="sticky-top pt-5">
        <Avatar :avatar-img="avatarImg"/>
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
    <template #content="{screenWidth, screenHeight}">
      <div class="row">
        <div class="col-lg-8">
          <AboutSection v-if="interventions" :items="interventions" title="Interventions"/>
          <AboutSection v-if="experiences" :items="experiences" title="Experiences"/>
          <AboutSection v-if="skills" :items="skills" title="Skills"/>
        </div>
        <div class="col-lg-4">
          <div class="sticky-top">
            <MediaThumbnail :animate="false" :media="meuf"/>
          </div>
        </div>
      </div>
    </template>
  </BaseTemplate>
</template>

<style scoped>

</style>