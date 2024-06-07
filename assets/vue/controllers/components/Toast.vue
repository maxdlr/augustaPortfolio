<script setup>
import {Toast} from 'bootstrap'
import {onMounted, ref, watch} from "vue";

const props = defineProps({
  message: {type: String, required: true},
  type: {
    type: String, required: true, default: 'success', validator: (value) => {
      return ['success', 'error'].includes(value);
    }
  },
  manualTrigger: {type: Boolean, required: false, default: false}
})

const toastRef = ref(null);
const toastEl = ref()
const toast = ref()
const trigger = defineModel('trigger', {
  type: Boolean, required: true
})

watch(trigger, (value) => {
  if (value) triggerToast();
})

const triggerToast = () => {
  toast.value = new Toast(toastEl.value, {});
  toast.value.show()

  toastEl.value.addEventListener('hidden.bs.toast', () => {
    trigger.value = false
  }, {once: true})
}

onMounted(() => {
  toastEl.value = toastRef.value

  if (props.manualTrigger) triggerToast()
})

</script>

<template>
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div
        id="liveToast"
        ref="toastRef"
        :class="type === 'success' ? 'text-bg-success' : 'text-bg-danger'"
        aria-atomic="true"
        aria-live="assertive"
        class="toast align-items-center border-0 rounded-pill"
        role="alert"
    >
      <div class="d-flex">
        <div class="toast-body fs-5">

          <div class="row">
            <i :class="type === 'success' ? 'bi-check-circle-fill' : 'x-circle-fill'" class="bi col-1 mx-3"></i>
            <span class="col">{{ message }}</span>
          </div>
        </div>
        <button
            aria-label="Close"
            class="btn-close btn-close-white me-2 m-auto"
            data-bs-dismiss="toast"
            type="button"></button>
      </div>

    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>