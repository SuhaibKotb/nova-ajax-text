Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-ajax-text', require('./components/IndexField'))
  Vue.component('detail-nova-ajax-text', require('./components/DetailField'))
  Vue.component('form-nova-ajax-text', require('./components/FormField'))
})
