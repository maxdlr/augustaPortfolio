<script setup>
const props = defineProps({
  isCurrentLocation: {type: Boolean, default: false, required: true},
  link: {type: Object, required: true}
})

const emit = defineEmits(['navigate']);


</script>

<template>
  <div class="">
    <span
        :href="link.link"
        class="text-light fs-title"
        @click.prevent="emit('navigate', link.link)">
      {{ link.label }}
    </span>
  </div>
</template>

<style scoped>

</style>