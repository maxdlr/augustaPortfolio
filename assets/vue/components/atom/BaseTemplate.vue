<script setup>
import {onMounted, onUnmounted, ref} from "vue";

const props = defineProps({
  anchor: {type: String, required: false, default: null},
  contextFlex: {type: Object, default: {justify: 'start', align: 'start'}},
  contentFlex: {type: Object, default: {justify: 'center', align: 'center'}},
  cols: {type: Array, default: [5, 7], required: false}
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
    <div :class="`justify-content-${contextFlex.justify} align-items-${contextFlex.align} col-md-${cols[0]}`"
         class="col-12 d-flex"
    >
      <slot :screenHeight="screenHeight" :screenWidth="screenWidth" name="context"/>
    </div>
    <div :class="`justify-content-${contentFlex.justify} align-items-${contentFlex.align} col-md-${cols[1]}`"
         class="col-12 d-flex"
    >
      <slot :screenHeight="screenHeight" :screenWidth="screenWidth" name="content"/>
    </div>
  </section>
</template>

<style scoped>

</style>