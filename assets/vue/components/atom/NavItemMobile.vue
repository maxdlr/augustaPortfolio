<script setup>
import Button from "../../controllers/components/Button.vue";

const props = defineProps({
  isCurrentLocation: {type: Boolean, default: false, required: true},
  link: {type: Object, required: true},
  iconSize: {type: [String, Number], default: 16, required: false}
})

const emit = defineEmits(['navigate']);

</script>

<template>
  <Button
      color-class=""
      size="lg"
      @click.prevent="emit('navigate', link.link)">
    <template #iconEnd>
      <svg v-if="link.label === 'motion'"
           :height="iconSize"
           :width="iconSize"
           class="bi bi-hexagon-fill"
           fill="currentColor"
           viewBox="0 0 16 16"
           xmlns="http://www.w3.org/2000/svg">
        <path
            d="M8.5.134a1 1 0 0 0-1 0l-6 3.577a1 1 0 0 0-.5.866v6.846a1 1 0 0 0 .5.866l6 3.577a1 1 0 0 0 1 0l6-3.577a1 1 0 0 0 .5-.866V4.577a1 1 0 0 0-.5-.866z"
            fill-rule="evenodd"/>
      </svg>

      <svg v-if="link.label === 'illustration'"
           :height="iconSize"
           :width="iconSize"
           class="bi bi-layers-fill"
           fill="currentColor"
           viewBox="0 0 16 16"
           xmlns="http://www.w3.org/2000/svg">
        <path
            d="M7.765 1.559a.5.5 0 0 1 .47 0l7.5 4a.5.5 0 0 1 0 .882l-7.5 4a.5.5 0 0 1-.47 0l-7.5-4a.5.5 0 0 1 0-.882z"/>
        <path
            d="m2.125 8.567-1.86.992a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882l-1.86-.992-5.17 2.756a1.5 1.5 0 0 1-1.41 0z"/>
      </svg>

      <svg v-if="link.label === 'about'"
           :height="iconSize"
           :width="iconSize"
           class="bi bi-person-fill"
           fill="currentColor"
           viewBox="0 0 16 16"
           xmlns="http://www.w3.org/2000/svg">
        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
      </svg>
    </template>
  </Button>
</template>

<style scoped>

</style>