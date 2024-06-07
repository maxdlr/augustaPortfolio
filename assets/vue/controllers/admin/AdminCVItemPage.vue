<script setup>
import Button from "../components/Button.vue";
import {Modal} from 'bootstrap';
import CVItem from "../../components/atom/CVItem.vue";
import {onMounted, ref} from "vue";
import Toast from "../components/Toast.vue";

const props = defineProps({
  CVItems: {type: Object, default: null},
  entityName: {type: String, required: true}
})

const site = window.location.origin;
const items = ref()
const emit = defineEmits(['toast'])

onMounted(() => {
  items.value = props.CVItems
})

const triggerToast = (message, type) => {
  toast.value = {message, type, trigger: true}
}
const toast = ref({})

const deleteMedia = async (id, title, index) => {
  if (confirm('Sure de vouloir supprimer ' + title + ' ?')) {
    await fetch(`${site}/cv-item/${id}/delete`)
        .then(r => r.json().then(data => ({ok: r.ok, body: data}))
            .then(obj => {
              if (obj.ok) {
                delete items.value[index]
                triggerToast(obj.body.message, 'success')
              }
            }));
  }
}

</script>

<template>

  <Button
      :label="entityName"
      color-class="primary"
      data-bs-target="#form-new-CVItem"
      data-bs-toggle="modal"
      icon-class-start="plus-circle-fill"
      round-class="pill"
      type="button"
  />

  <div v-for="(item,index) in items" :key="index">

    <div class="d-flex justify-content-start align-items-center">

      <CVItem v-if="item" :item="item" class="py-3 pe-3"/>

      <Button
          v-if="item"
          :data-bs-target="`#form-CVItem-${item.id}`"
          color-class="warning"
          data-bs-toggle="modal"
          label="modifier"
          round-class="pill"
          type="button"
      />
      <Button
          v-if="item"
          color-class="danger"
          label="supprimer"
          round-class="pill"
          type="button"
          @click.prevent="deleteMedia(item.id, item.title, index)"
      />
    </div>
  </div>

  <Toast v-model:trigger="toast.trigger" :message="toast.message" :type="toast.type"/>

</template>

<style lang="scss" scoped>

</style>