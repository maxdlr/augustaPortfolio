<script setup>
const props = defineProps({
  anchor: {type: String, required: false, default: null},
  contextFlex: {type: Object, default: {justify: 'start', align: 'center'}},
  contentFlex: {type: Object, default: {justify: 'center', align: 'center'}},
})
</script>

<template>
  <div v-if="anchor" aria-hidden="true" :id="anchor"></div>
  <section class="row mx-5 py-4" style="min-height: 40vw !important;">
    <div class="col-5 d-flex"
         :class="`justify-content-${contextFlex.justify} align-items-${contextFlex.align}`"
    >
      <slot name="context"/>
    </div>
    <div class="col-7 d-flex"
         :class="`justify-content-${contentFlex.justify} align-items-${contentFlex.align}`"
    >
    <slot name="content"/>
    </div>
  </section>
</template>

<style scoped>

</style>