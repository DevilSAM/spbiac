<template>
  <div class="">
    <label :for="elementId" class="block text-sm font-medium text-gray-700">{{ label }}</label>
    <input
      :class="[error ? 'border-red-500' : '', 'mt-1 form-input']"
      :id="elementId"
      :name="name"
      :type="type"
      :placeholder="placeholder"
      :required="required"
      :readonly="readonly"
      :enterkeyhint="enterKeyHint"
      @input="updateModelValue"
      :pattern="type === 'number' ? '[0-9]*' : null"
      step=".001"
      :autocomplete="autocomplete !== '' ? autocomplete : null"
      v-model="value"
    >
    <div class="mt-1 text-sm text-gray-500" v-if="help" v-html="help"></div>
    <div class="mt-1 text-sm text-red-500" v-if="error">{{ typeof error === 'object' ? error.join(',') : error }}</div>
  </div>
</template>

<script lang="ts">
export default {
  name: "InputText",
  emits: ['update:modelValue'],
  props: {
    modelValue: String,
    label: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    id: {
      type: String,
      default: '',
    },
    type: {
      type: String,
      default: 'text',
    },
    enterKeyHint: {
      type: String,
      default: '',
    },
    autocomplete: {
      type: String,
      default: '',
    },
    error: {
      type: [String, Number, Object],
      default: null,
    },
    help: {
      type: [String, Number],
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    readonly: {
      type: Boolean,
      default: false,
    },
    required: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      value: this.modelValue,
      elementId: this.id ? this.id : this.name
    }
  },
  methods: {
    updateModelValue(event: { target: { value: any; }; }) {
      this.$emit('update:modelValue', event.target.value)
    },
  }
}
</script>
