<script setup>
import {toTitle} from "../../composable/formatter/string";
import {ref} from "vue";

const props = defineProps({
  item: {type: Object, required: true}
})

const hovering = ref();

</script>

<template>
  <div @mouseenter="hovering = true"
       @mouseleave="hovering = false"
       class="p-2 pt-3 px-4 rounded-5"
       :class="[
          hovering ? 'bg-info' : ''
      ]"
  >
    <a
        :href="item.link"
        class="link-underline link-underline-opacity-0"
    >
      <h6 class="fs-6 m-0">
        <span
            class="fs-title"
            :class="hovering ? 'text-white' : 'text-primary'"
        >{{toTitle(item.title) + ' '}}</span>
        <span
            :class="hovering ? 'text-white' : 'text-info'"
        >@{{item.labelLink}}</span>
      </h6>
      <div
          :class="hovering ? 'text-white' : 'text-secondary'"
      >
        <span class="ps-2 d-inline-block text-truncate" style="max-width: 350px;">{{item.description}}</span>
      </div>
    </a>
  </div>
</template>

<style scoped>

</style>