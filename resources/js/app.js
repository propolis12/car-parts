import { createApp } from 'vue'
import CarForm from './components/CarForm.vue'

const el = document.getElementById('car-form')
if (el) {
    const initial = JSON.parse(el.dataset.initial || '{}')
    createApp(CarForm, { initial }).mount(el)
}
