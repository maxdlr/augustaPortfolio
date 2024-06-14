<script setup>
import BaseTemplate from "../atom/BaseTemplate.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import Button from "../../controllers/components/Button.vue";
import {useClipboard} from '@vueuse/core'
import {ref} from "vue";

const email = ref('augusta@qimono.tv')
const {copy, copied} = useClipboard({email})

const props = defineProps({
  contactImgs: {type: Object, required: true},
  anchor: {type: String, required: true}, isTopBarActive: {type: Boolean}
})

</script>

<template>
  <div class="pb-3">
    <BaseTemplate :anchor="anchor"
                  :cols="contactImgs < 3 ? [3, 9] : [5, 7]"
                  :context-flex="{justify: {md: 'center'}, align: {md: 'start'}}"
                  :is-top-bar-active="isTopBarActive"
    >
      <template #context>
        <div class="fs-2 ">
          <div>
            <span class="text-secondary">Un projet</span>
            <span class="text-info"> ?</span>
          </div>
          <a class="cursor-pointer" href="mailto:augusta@qimono.tv">
            <div class="text-nowrap">
              <span class="text-primary">On en parle </span>
              <span class="text-secondary"> ici ❤️</span>
            </div>
          </a>
        </div>
        <div class="py-2">
          <Button
              :color-class="copied ? 'success' : 'info'"
              :icon-class-start="copied ? 'check-circle-fill' : 'copy'"
              :label="copied ? 'email copied!' : 'email'"
              custom-pointer
              @click.prevent="copy(email)"
          />
        </div>
      </template>
      <template v-if="contactImgs" #content>
        <div :class="contactImgs.length < 2 ? 'w-50' : contactImgs.length < 3 ? 'w-75' : ''"
             class="py-5 mb-5 py-lg-0 d-flex justify-content-center align-items-center"
        >
          <div
              v-if="contactImgs[0]"
              class="rotateContactStart contactImg">
            <MediaThumbnail :media="contactImgs[0]"/>
          </div>
          <div
              v-if="contactImgs[1] && contactImgs.length > 2"
              class="z-2 contactImg">
            <MediaThumbnail :media="contactImgs[1]"/>
          </div>
          <div
              v-if="contactImgs[contactImgs.length > 2 ? 2 : 1]"
              class="rotateContactEnd contactImg">
            <MediaThumbnail :media="contactImgs[contactImgs.length > 2 ? 2 : 1]"/>
          </div>
        </div>
      </template>
    </BaseTemplate>
  </div>
</template>

<style lang="scss" scoped>
.rotateContactStart {
  transform: translate(20%, 5%) rotate(-10deg) !important;
}

.rotateContactEnd {
  transform: translate(-20%, 5%) rotate(10deg) !important;
}

.contactImg {
  width: clamp(100px, 50%, 300px) !important;
}
</style>