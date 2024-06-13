<script setup>
import {onMounted, onUnmounted, ref} from "vue";

const props = defineProps({
  anchor: {type: String, required: false, default: null},
  contextFlex: {type: Object, default: {justify: {md: 'start'}, align: {md: 'center'}}},
  contentFlex: {type: Object, default: {justify: {md: 'center'}, align: {md: 'center'}}},
  cols: {type: Array, default: [5, 7], required: false},
  mainBreakPoint: {type: String, default: 'lg', required: false},
  stickyContext: {type: Boolean, default: false, required: false},
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
      class="py-5 py-md-3"
  ></div>
  <section :class="`mx-${mainBreakPoint}-5 my-${mainBreakPoint}-5`" class="row my-2 mx-1">
    <div
        :class="[
            contextFlex ? [
                contextFlex.justify ? [
                    contextFlex.justify.sm ? `justify-content-${contextFlex.justify.sm}`: '',
                    contextFlex.justify.md ? `justify-content-md-${contextFlex.justify.md}`: '',
                    contextFlex.justify.lg ? `justify-content-lg-${contextFlex.justify.lg}`: '',
                    contextFlex.justify.xl ? `justify-content-xl-${contextFlex.justify.xl}`: '',
                ] : '',
                contextFlex.align ? [
                    contextFlex.align.sm ? `align-items-${contextFlex.align.sm}`: '',
                    contextFlex.align.md ? `align-items-md-${contextFlex.align.md}`: '',
                    contextFlex.align.lg ? `align-items-lg-${contextFlex.align.lg}`: '',
                    contextFlex.align.xl ? `align-items-xl-${contextFlex.align.xl}`: '',
                ] : '',
            ] : '',
            $slots.content ? `col-${mainBreakPoint}-${cols[0]}` : 'text-center'
            ]"
        class="col-12 d-flex"
    >
      <article :class="[!$slots.content ? 'mx-auto' : '', stickyContext ? 'sticky-top' : '']">
        <slot
            :screenHeight="screenHeight"
            :screenWidth="screenWidth"
            name="context"
        />
      </article>
    </div>
    <article v-if="$slots.content"
             :class="[
            contentFlex ? [
                contentFlex.justify ? [
                    contentFlex.justify.sm ? `justify-content-${contentFlex.justify.sm}`: '',
                    contentFlex.justify.md ? `justify-content-md-${contentFlex.justify.md}`: '',
                    contentFlex.justify.lg ? `justify-content-lg-${contentFlex.justify.lg}`: '',
                    contentFlex.justify.xl ? `justify-content-xl-${contentFlex.justify.xl}`: '',
                ] : '',
                contentFlex.align ? [
                    contentFlex.align.sm ? `align-items-${contentFlex.align.sm}`: '',
                    contentFlex.align.md ? `align-items-md-${contentFlex.align.md}`: '',
                    contentFlex.align.lg ? `align-items-lg-${contentFlex.align.lg}`: '',
                    contentFlex.align.xl ? `align-items-xl-${contentFlex.align.xl}`: '',
                ] : '',
            ] : '',
            `col-${mainBreakPoint}-${cols[1]}`
            ]"
             class="col-12 d-flex"
    >
      <slot :screenHeight="screenHeight" :screenWidth="screenWidth" name="content"/>
    </article>
  </section>
</template>