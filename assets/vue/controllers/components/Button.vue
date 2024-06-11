<script setup>
import {toTitle} from "../../composable/formatter/string";
import {SLIDE_LEFT, SLIDE_RIGHT} from "../../constant/animation";

defineProps({
  label: {type: [String, Number, Boolean], default: null},
  colorClass: {type: String, default: "primary"},
  size: {type: String, default: null},
  roundClass: {type: String, default: 'pill'},
  iconClassStart: {type: String, default: null},
  iconClassEnd: {type: String, default: null},
  type: {
    type: String, default: "", validator(value) {
      return ['submit', 'reset', 'button', ''].includes(value)
    }
  },
  animate: {
    type: [String, Boolean], default: false, validator(value) {
      return ['right', 'left'].includes(value);
    }
  },
  customPointer: {type: Boolean, default: false, required: false},
});
</script>

<template>
  <button
      :class="[
      `btn-${colorClass}`,
      !size ? '' : `btn-${size}`,
      roundClass ? `rounded-${roundClass}` : '',
      customPointer ? 'cursor-pointer' : ''
    ]"
      :type="type"
      class="btn text-nowrap"
      role="button"
  >
    <slot name="iconStart">
      <i :class="`bi bi-${iconClassStart}`"></i>
    </slot>
    <Transition :name="animate ? animate === 'right' ? SLIDE_RIGHT : SLIDE_LEFT : null">
      <span v-if="label" :class="[
          $slots['iconStart'] || iconClassStart ? 'ps-2' : '',
          $slots['iconEnd'] || iconClassEnd ? 'pe-2' : '',
          $slots['iconEnd'] || iconClassEnd || $slots['iconStart'] || iconClassStart ? 'd-none d-md-inline' : ''
            ]"
      >
        {{ typeof label === 'boolean' ? label.toString() : toTitle(label) }}
      </span>
    </Transition>
    <slot name="iconEnd">
      <i :class="`bi bi-${iconClassEnd}`"></i>
    </slot>
  </button>
</template>

<style lang="scss" scoped>
@import "../../../styles/slide-left";
@import "../../../styles/slide-right";
</style>
