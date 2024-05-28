<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import Avatar from "../molecule/Avatar.vue";
import AboutSection from "../molecule/AboutSection.vue";

const props = defineProps({
  avatarImg: {type: Object, required: true},
  anchor: {type: String, required: true},
  interventions: {type: Object},
  experiences: {type: Object},
  skills: {type: Object},
})

const site = window.location.origin;

</script>

<template>
<BaseTemplate
    :anchor="anchor"
    :context-flex="{justify: 'center', align: 'start'}"
>
  <template #context>
    <div class="sticky-top">
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
    <div class="h-100">
      <AboutSection title="Interventions" :items="interventions"/>
      <AboutSection title="Experiences" :items="experiences"/>
      <AboutSection title="Skills" :items="skills"/>
    </div>
  </template>
</BaseTemplate>
</template>

<style scoped>

</style>