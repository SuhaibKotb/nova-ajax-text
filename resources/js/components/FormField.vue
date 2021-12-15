<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template slot="field">
            <input
                :id="field.name"
                type="text"
                :disabled="disabled"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
            />

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'
    export default {
        mixins: [FormField, HandlesValidationErrors],
        props: ['resourceName', 'resourceId', 'field'],
        data() {
            return {
                value: null,
                loaded: false,
                parentValue: null,
                alwaysDisabled: false,
            }
        },
        mounted() {
            this.watchedComponents.forEach(component => {
                let attribute = 'value';
                component.$watch(attribute, (value) => {
                    this.parentValue = value;
                    this.updateValue();
                }, { immediate: true });
            });

            if (this.field.always_disabled) {
              this.alwaysDisabled = this.field.always_disabled;
            }
        },
        computed: {
            watchedComponents() {
                return this.$parent.$children.filter(component => {
                    return this.isWatchingComponent(component);
                })
            },
            endpoint() {
                return this.field.endpoint
                    .replace('{resource-name}', this.resourceName)
                    .replace('{resource-id}', this.resourceId ? this.resourceId : '')
                    .replace('{'+ this.field.parent_attribute +'}', this.parentValue ? this.parentValue : '')
            },
            empty() {
                return this.loaded && this.value == null;
            },
            disabled() {
              if (this.alwaysDisabled) {
                return true;
              }
                return this.loaded === false && (this.field.parent_attribute !== undefined && this.parentValue == null) || this.value == null;
            },
        },
        methods: {
            setInitialValue() {
                this.value = this.field.value || ''
            },
            fill(formData) {
                formData.append(this.field.attribute, this.value || '')
            },
            updateValue() {
                this.value = null;
                this.loaded = false;
                if(this.notWatching() || (this.parentValue != null && this.parentValue !== '')) {
                    Nova.request().get(this.endpoint)
                        .then(response => {
                            this.loaded = true;
                            this.value = response.data;
                        })
                }
            },
            notWatching() {
                return this.field.parent_attribute === undefined;
            },
            isWatchingComponent(component) {
                return component.field !== undefined
                    && component.field.attribute === this.field.parent_attribute;
            }
        },
    }
</script>
