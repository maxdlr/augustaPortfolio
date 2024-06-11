<script setup>
import Button from "../../controllers/components/Button.vue";
import {Modal} from 'bootstrap';
import {onMounted, ref} from "vue";
import HelpBox from "../atom/HelpBox.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import AdminDashboardWidget from "./AdminDashboardWidget.vue";

const props = defineProps({
  websiteConfig: {type: Object, required: false},
  websiteConfigFormId: {type: String, required: true}
})
</script>

<template>
  <AdminDashboardWidget title="Les metadata">
    <template #content1>
      <div v-if="websiteConfig">
        {{ websiteConfig }}
      </div>
      <div v-else>
        <span class="fs-6 fst-italic text-secondary">
          --- Metadata par défaut ---
        </span>
      </div>
    </template>
    <template #buttons1>
      <Button
          :color-class="websiteConfig ? 'warning' : 'primary'"
          :data-bs-target="`#${websiteConfigFormId}`"
          :icon-class-start="websiteConfig ? 'pencil-fill' : 'plus-circle-fill'"
          :label="websiteConfig ? 'modifier' : 'ajouter'"
          class="m-2"
          data-bs-toggle="modal"
          round-class="pill"
          type="button"
      />
    </template>
    <template #footer>
      <div class="text-start">
        <HelpBox :instructions="[
      'Acceptés: .jpeg, .png, .webp, .gif',
        'Fait gaffe que ce soit pas trop lourd - 50mo max'
    ]" :start-collapsed="true"
        />
      </div>
    </template>
  </AdminDashboardWidget>
</template>