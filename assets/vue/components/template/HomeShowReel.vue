<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import {onMounted, ref} from "vue";
import Button from "../../controllers/components/Button.vue";
import {BREAKPOINTS} from "../../constant/bootstrap-constants";
import {Modal} from 'bootstrap';

const props = defineProps({
  showreelThumbnailPath: {type: String, required: false},
  showreelVideoId: {type: String, required: false},
  anchor: {type: String, required: true}
})

const showreelWidth = ref(1400);

const modalContentRef = ref(null)
const modalContent = ref();
const showreelIframeElement = ref();
const modalElRef = ref(null)
const modalEl = ref();

onMounted(() => {
  modalContent.value = modalContentRef.value
  modalEl.value = modalElRef.value

  if (window.location.hash === '#showreel') showShowReel();
})

const openModal = () => {
  const modal = new Modal(modalEl.value)
  modal.show()

  modalEl.value.addEventListener('hide.bs.modal', () => {
    window.location.hash = '/';
    destroyShowreelVideo();
  }, {once: true})
}

const closeModal = () => {
  const modal = new Modal(modalEl.value)
  modal.hide();
  destroyShowreelVideo();
  window.location.hash = '/'
}

const showShowReel = () => {
  window.location.hash = 'showreel'
  const showreelIframe = document.createElement('iframe')
  showreelIframe.setAttribute('src', `https://player.vimeo.com/video/${props.showreelVideoId}?h=39dc51fa45&autoplay=1&byline=0`)
  showreelIframe.setAttribute('width', showreelWidth.value + '')
  showreelIframe.setAttribute('height', showreelWidth.value / 16 * 9 + '')
  showreelIframe.setAttribute('allowfullscreen', true + '')
  showreelIframeElement.value = showreelIframe;
  modalContent.value.appendChild(showreelIframeElement.value)

  openModal();
}

const destroyShowreelVideo = () => {
  showreelIframeElement.value.remove()
}

</script>

<template>
  <BaseTemplate
      :anchor="anchor"
      :context-flex="{justify: {sm: 'center', md: 'start'}, align: {sm: 'center'}}"
  >
    <template #context="{screenWidth}">
      <div
          :class="screenWidth < BREAKPOINTS.SM ? 'fs-4' : 'fs-1'"
          class="text-center text-md-start"
      >
        <div class="d-block d-sm-inline d-md-block py-3 py-md-0">
          <span class="text-info">Motion designer</span>
          <span class="text-secondary"> & </span>
          <span class="text-primary">Illustrator</span>
        </div>
      </div>
    </template>
    <template #content="{screenWidth}">
      <div v-if="showreelThumbnailPath" class="rounded-4 overflow-hidden">
        <img :src="'build/media/' + showreelThumbnailPath" alt="Augusta Sarlin's showreel thumbnail"
             class="img-fluid eye-cursor"
             type="button"
             @click.prevent="showShowReel"
        >
      </div>
    </template>
  </BaseTemplate>

  <div id="showreel-mediaLightBox" ref="modalElRef" aria-hidden="true" aria-labelledby="showreel-mediaLightBoxLabel"
       class="modal modal-xl fade" tabindex="-1" @keydown.esc="closeModal">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header bg-dark d-flex justify-content-between align-items-center border-0"
             @keydown.esc="closeModal">
          <span class="text-light z-3 p-4">[ESC] - Close</span>
          <Button aria-label="Close" class="text-white" color-class="" data-bs-dismiss="modal" icon-class-start="x-lg"
                  size="lg" type="button" @click.prevent="closeModal"/>
        </div>
        <div ref="modalContentRef" class="modal-body bg-dark d-flex align-items-center justify-content-center"
             @keydown.esc="closeModal"/>
      </div>
    </div>
  </div>

</template>

<style lang="scss" scoped>

.eye-cursor {
  cursor: url("../../../../public/build/media/cursor/eye-cursor.webp"), zoom-in;
}

</style>