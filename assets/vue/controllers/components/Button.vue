<script setup>
import {toTitle} from "../../composable/formatter/string";

defineProps({
  label: {type: [String, Number, Boolean], default: null},
  colorClass: {type: String, default: "primary"},
  size: {type: String, default: null},
  roundClass: {type: String, default: 'pill'},
  iconClassStart: {type: String, default: null},
  iconClassEnd: {type: String, default: null},
  type: {type: String, default: "", validator(value) {
    return ['submit', 'reset', 'button', ''].includes(value)
    }}
});
</script>

<template>
  <button
      class="btn text-nowrap"
      :type="type"
      role="button"
      :class="[
      `btn-${colorClass}`,
      !size ? '' : `btn-${size}`,
      roundClass ? `rounded-${roundClass}` : '',
    ]"
  >
    <slot name="iconStart">
      <i :class="`bi bi-${iconClassStart}`"></i>
    </slot>
    <span v-if="label" :class="[
        $slots['iconStart'] || iconClassStart ? 'ps-2' : '',
        $slots['iconEnd'] || iconClassEnd ? 'pe-2' : ''
          ]">
      {{ typeof label === 'boolean' ? label.toString() : toTitle(label) }}
    </span>
    <slot name="iconEnd">
      <i :class="`bi bi-${iconClassEnd}`"></i>
    </slot>
  </button>
</template>
