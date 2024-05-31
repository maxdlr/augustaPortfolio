<script setup>
import {onMounted, onUnmounted, ref} from "vue";

const props = defineProps({
  anchor: {type: String, required: false, default: null},
  contextFlex: {type: Object, default: {justify: 'start', align: 'center'}},
  contentFlex: {type: Object, default: {justify: 'center', align: 'center'}},
})

const screenWidth = ref(0);
const screenHeight = ref(0);

onMounted(() => {
  handleResize();
  window.addEventListener("resize", handleResize);
});
onUnmounted(() => {
  window.removeEventListener("resize", handleResize);
});

const handleResize = () => {
  screenWidth.value = window.innerWidth;
  screenHeight.value = window.innerHeight;
};

</script>

<template>
  <div
      v-if="anchor"
      :id="anchor"
      aria-hidden="true"
      class="py-3"
  ></div>
  <section class="row mx-md-5 mx-1" style="min-height: 40vw !important;">
    <div :class="`justify-content-${contextFlex.justify} align-items-${contextFlex.align}`"
         class="col-md-5 col-12 d-flex"
    >
      <slot :screenHeight="screenHeight" :screenWidth="screenWidth" name="context"/>
    </div>
    <div :class="`justify-content-${contentFlex.justify} align-items-${contentFlex.align}`"
         class="col-md-7 col-12 d-flex"
    >
      <slot :screenHeight="screenHeight" :screenWidth="screenWidth" name="content"/>
    </div>
  </section>
</template>

<style scoped>

</style>