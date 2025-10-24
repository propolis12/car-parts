<template>
    <div class="row g-3">
        <div class="col-12">
            <label class="form-label">Názov auta</label>
            <input type="text" class="form-control" name="name" v-model="form.name" required maxlength="255" />
        </div>

        <div class="col-12 d-flex align-items-center gap-2">
            <input id="is_registered" type="checkbox" v-model="form.is_registered" />
            <label for="is_registered" class="form-label m-0">Auto je registrované</label>
            <input type="hidden" name="is_registered" :value="form.is_registered ? 1 : 0" />
        </div>

        <div class="col-md-6" v-if="form.is_registered">
            <label class="form-label">EČV (registration_number)</label>
            <input type="text" class="form-control" name="registration_number"
                   v-model="form.registration_number" :required="form.is_registered" maxlength="30" />
            <div class="form-text">Povinné, ak je auto registrované.</div>
        </div>
    </div>
</template>

<script setup>
import { reactive, watch } from 'vue'

const props = defineProps({
    initial: { type: Object, default: () => ({ name: '', is_registered: false, registration_number: '' }) }
})

const form = reactive({
    name: props.initial?.name ?? '',
    is_registered: Boolean(props.initial?.is_registered ?? false),
    registration_number: props.initial?.registration_number ?? ''
})

watch(() => form.is_registered, v => { if (!v) form.registration_number = '' })
</script>
