<script setup>
import AdminAvatar from "../../components/template/AdminAvatar.vue";
import AdminCursors from "../../components/template/AdminCursors.vue";
import AdminShowreel from "../../components/template/AdminShowreel.vue";
import AdminMeuf from "../../components/template/AdminMeuf.vue";
import Toast from '../components/Toast.vue'
import {ref} from "vue";
import AdminWebsiteConfig from "../../components/template/AdminWebsiteConfig.vue";
import AdminSocialItems from "../../components/template/AdminSocialItems.vue";

const props = defineProps({
  avatarImg: {type: Object, required: false},
  avatarFormId: {type: String},
  showreelImg: {type: Object, required: false},
  showreelThumbnailFormId: {type: String},
  showreelVideoFormId: {type: String, required: true},
  showreelVideoId: {type: Object, required: true},
  meufImg: {type: Object, required: false},
  meufFormId: {type: String},
  cursorImgs: {type: Object, required: true},
  cursorFormIds: {type: Array},
  websiteConfigFormId: {type: String},
  websiteConfig: {type: Object, required: false},
  favicon: {type: Object, required: false},
  isDefaultWebsiteConfig: {type: Object, required: true},
  socialItems: {type: Object, required: false}
})

const triggerToast = (message, type) => {
  toast.value = {message, type, trigger: true}
}
const toast = ref({})

</script>

<template>
  <section>
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3">
      <div class="p-2">
        <AdminAvatar :avatar-img="avatarImg" :form-id="avatarFormId" @toast="triggerToast"/>
      </div>
      <div class="p-2">
        <AdminShowreel
            :showreel-img="showreelImg"
            :showreel-thumbnailform-id="showreelThumbnailFormId"
            :showreel-video-form-id="showreelVideoFormId"
            :showreel-video-id="showreelVideoId"
            @toast="triggerToast"
        />
      </div>
      <div class="p-2">
        <AdminMeuf :form-id="meufFormId" :meuf-img="meufImg" @toast="triggerToast"/>
      </div>
      <div class="p-2">
        <AdminCursors :cursor-form-ids="cursorFormIds" :cursor-imgs="cursorImgs" @toast="triggerToast"/>
      </div>
      <div class="p-2">
        <AdminWebsiteConfig
            :favicon="favicon"
            :is-default-website-config="isDefaultWebsiteConfig"
            :website-config-form-id="websiteConfigFormId"
            :websiteConfig="websiteConfig"
        />
      </div>
      <div class="p-2">
        <AdminSocialItems :social-items="socialItems"/>
      </div>
    </div>
  </section>
  <Toast v-model:trigger="toast.trigger" :message="toast.message" :type="toast.type"/>
</template>

<style lang="scss" scoped>
</style>