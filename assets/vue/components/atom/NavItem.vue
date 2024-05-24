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
      :href="value"
      class="link-underline-opacity-0 link-underline fs-4"
      :class="[
          `link-${colorClass}`
      ]"
  >{{toTitle(label)}}</a>
</template>

<style scoped>

</style>