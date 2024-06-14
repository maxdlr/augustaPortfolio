<script setup>
import {Toast} from 'bootstrap'
import {onMounted, onUnmounted, ref, watch} from "vue";
import {BREAKPOINTS} from "../../constant/bootstrap-constants";

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
  <div :class="screenWidth >= BREAKPOINTS.SM ? 'top-0' : 'bottom-0'"
       class="toast-container position-fixed end-0 p-3">
    <div
        id="liveToast"
        ref="toastRef"
        :class="type === 'success' ? 'text-bg-success' : 'text-bg-danger'"
        aria-atomic="true"
        aria-live="assertive"
        class="toast align-items-center border-0 rounded-pill px-1"
        role="alert"
        style="width: fit-content !important;"
    >
      <div class="d-flex">
        <div class="toast-body fs-5">

          <div class="row">
            <i :class="type === 'success' ? 'b' +
             'i-check-circle-fill' : 'x-circle-fill'" class="bi col-1 mx-3"></i>
            <span class="col text-nowrap">{{ message }}</span>
          </div>
        </div>
        <div class="mx-3 d-flex justify-content-center align-items-center">
          <button
              aria-label="Close"
              class="btn-close btn-close-white m-auto"
              data-bs-dismiss="toast"
              type="button"></button>
        </div>
      </div>
    </div>
  </div>
</template>