<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import {onMounted, ref} from "vue";
import Button from "../../controllers/components/Button.vue";

const props = defineProps({
  showreelThumbnailPath: {type: String, required: false}
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
  <div id="showreel"></div>
  <BaseTemplate>
    <template #context>
      <div class="fs-1">
        <div>
          <span class="text-secondary">Freelance</span>
        </div>
        <div>
          <span class="text-info">motion designer</span>
          <span class="text-secondary"> & </span>
          <span class="text-primary">illustrator</span>
        </div>
        <div>
          <span class="text-secondary">based in Lyon, France</span>
        </div>
      </div>
    </template>

    <template #content>
      <div class="rounded-4 overflow-hidden">
        <img class="img-fluid" :src="showreelThumbnailPath" alt="Augusta Sarlin's showreel thumbnail"
             data-bs-toggle="modal"
             data-bs-target="#showreel-mediaLightBox"
             type="button"
             @click="createShowreelVideo"
        >
      </div>
    </template>
  </BaseTemplate>

  <div class="modal modal-xl fade" id="showreel-mediaLightBox" tabindex="-1" aria-labelledby="showreel-mediaLightBoxLabel" aria-hidden="true" @keydown.esc="destroyShowreelVideo">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header bg-dark d-flex justify-content-between align-items-center border-0">
          <span class="text-light z-3 p-4">[ESC] - Close</span>
          <Button color-class="" class="text-white" size="lg" icon-class-start="x-lg" data-bs-dismiss="modal" aria-label="Close" type="button" @click="destroyShowreelVideo" />
        </div>
        <div class="modal-body bg-dark d-flex align-items-center justify-content-center" ref="modalContentRef"/>
      </div>
    </div>
  </div>

</template>

<style scoped>

</style>