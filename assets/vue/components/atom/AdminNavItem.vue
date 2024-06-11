<script setup>
import Button from "../../controllers/components/Button.vue";
import {goTo} from "../../composable/action/redirect";
import {toTitle} from "../../composable/formatter/string";

const props = defineProps({
  label: {type: String, required: true},
  value: {type: String, required: true},
  iconClass: {type: String, default: null},
  colorClass: {type: String, default: 'outline-primary'},
  size: {
    type: String, default: null, validator(value) {
      return ['sm', 'lg'].includes(value)
    }
  }
})
</script>

<template>
  <Button :color-class="colorClass"
          :icon-class-start="iconClass ? iconClass : null"
          :label="toTitle(label)"
          :size="size"
          @click.prevent="goTo(value)"
  />
</template>