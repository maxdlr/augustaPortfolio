<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import {onMounted, ref} from "vue";
import Button from "../../controllers/components/Button.vue";
import {BREAKPOINTS} from "../../constant/bootstrap-constants";

const props = defineProps({
  showreelThumbnailPath: {type: String, required: false},
  anchor: {type: String, required: true}
})

const showreelWidth = ref(1600);

const modalContentRef = ref(null)
const modalContent = ref();
const showreelIframeElement = ref();

onMounted(() => {
  modalContent.value = modalContentRef.value
})

const createShowreelVideo = () => {
  const showreelIframe = document.createElement('iframe')
  showreelIframe.setAttribute('src', "https://player.vimeo.com/video/823390186?h=39dc51fa45&autoplay=1&byline=0")
  showreelIframe.setAttribute('width', showreelWidth.value + '')
  showreelIframe.setAttribute('height', showreelWidth.value / 16 * 9 + '')
  showreelIframe.setAttribute('allowfullscreen', true + '')
  showreelIframeElement.value = showreelIframe;
  modalContent.value.appendChild(showreelIframeElement.value)
}

const destroyShowreelVideo = () => {
  showreelIframeElement.value.remove()
}

</script>

<template>
  <BaseTemplate
      :anchor="anchor"
      :context-flex="{justify: 'md-start justify-content-center', align: 'center'}"
  >
    <template #context="{screenWidth}">
      <div
          :class="screenWidth < BREAKPOINTS.SM ? 'fs-4' : 'fs-1'"
          class="text-center text-md-start"

      >
        <div class="d-none d-md-block">
          <span class="text-secondary">Freelance </span>
        </div>
        <div class="d-block d-sm-inline d-md-block py-3 py-md-0">
          <span class="text-info">Motion designer</span>
          <span class="text-secondary"> & </span>
          <span class="text-primary">Illustrator</span>
        </div>
        <div class="d-none d-md-block">
          <span
              :class="screenWidth < BREAKPOINTS.SM ? 'fs-6' : 'fs-3'"
              class="text-secondary"
          >based in Lyon, France</span>
        </div>
      </div>
    </template>

    <template #content="{screenWidth}">
      <div class="rounded-4 overflow-hidden">
        <img :src="showreelThumbnailPath" alt="Augusta Sarlin's showreel thumbnail" class="img-fluid"
             data-bs-target="#showreel-mediaLightBox"
             data-bs-toggle="modal"
             type="button"
             @click="createShowreelVideo"
        >
      </div>
    </template>
  </BaseTemplate>

  <div id="showreel-mediaLightBox" aria-hidden="true" aria-labelledby="showreel-mediaLightBoxLabel"
       class="modal modal-xl fade" tabindex="-1" @keydown.esc="destroyShowreelVideo">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header bg-dark d-flex justify-content-between align-items-center border-0">
          <span class="text-light z-3 p-4">[ESC] - Close</span>
          <Button aria-label="Close" class="text-white" color-class="" data-bs-dismiss="modal" icon-class-start="x-lg"
                  size="lg" type="button" @click="destroyShowreelVideo"/>
        </div>
        <div ref="modalContentRef" class="modal-body bg-dark d-flex align-items-center justify-content-center"/>
      </div>
    </div>
  </div>

</template>

<style scoped>

</style>