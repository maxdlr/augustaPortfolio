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
      v-if="value.includes('#')"
      v-smooth-scroll="{ duration: 200, easingFunction: t => 1+(--t)*t*t*t }"
      :class="[
          `link-${colorClass}`
      ]"
      :href="value"
      class="link-underline-opacity-0 link-underline fs-4 item-hover text-nowrap"
  >{{ toTitle(label) }}</a>
  <a
      v-else
      :class="[
          `link-${colorClass}`
      ]"
      :href="value"
      class="link-underline-opacity-0 link-underline fs-4 item-hover text-nowrap"
  >{{ toTitle(label) }}</a>

</template>

<style lang="scss" scoped>
@import '../../../styles/var-override';
@import '../../../styles/animation';

.item-hover {
  transition: all $duration $timing;

  &:before, &:after {
    transform: scale(0);
  }

  &:hover {
    color: $info !important;
    position: relative;

    &:before, &:after {
      width: 20px;
      content: '';
      display: block;
      position: absolute;
      translate: -50% -50%;
      aspect-ratio: 1/1;
      background-color: $info;
      border-radius: 10px;
      transform: scale(50%);
      top: 50%;
    }

    &:before {
      left: -20px;
    }

    &:after {
      left: calc(100% + 20px);
    }
  }

  &:active {
    color: $primary !important;
  }
}

</style>