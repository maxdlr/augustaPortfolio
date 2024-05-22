<script setup>
const props = defineProps({
  anchor: {type: String, required: false, default: null}
})
</script>

<template>
  <div v-if="anchor" aria-hidden="true" :id="anchor"></div>
  <section class="row mx-5" style="min-height: 40vw !important;">
    <div class="col-5 d-flex justify-content-start align-items-center">
      <slot name="context"/>
    </div>
    <div class="col-7 d-flex justify-content-center align-items-center">
    <slot name="content"/>
    </div>
  </section>
</template>

<style scoped>

</style>