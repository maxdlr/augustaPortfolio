<script setup>
import {toTitle} from "../../composable/formatter/string";

const props = defineProps({
  label: {type: String, required: true},
  value: {type: String, required: true},
  iconClass: {type: String, default: null},
  colorClass: {type: String, default: 'secondary'},
  size: {
    type: String, default: null, validator(value) {
      return ['sm', 'lg'].includes(value)
    }
  }
})
</script>

<template>
  <a
      v-smooth-scroll="{ duration: 200, easingFunction: t => 1+(--t)*t*t*t }"
      :class="[
          `link-${colorClass}`
      ]"
      :href="value"
      class="link-underline-opacity-0 link-underline fs-4"
  >{{ toTitle(label) }}</a>
</template>

<style scoped>

</style>