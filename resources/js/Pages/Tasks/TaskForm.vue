<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    name: "",
    description: "", // Added description field
});

const submit = () => {
    form.post(route("tasks.store"), {
        onFinish: () => {
            form.reset("name", "description"); // Reset fields after successful submission
        },
    });
};
</script>

<template>
    <Head title="Task Form" />

    <AuthenticationCard>
        <!-- Your form structure -->
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="description" value="Description" />
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="description"
                />
                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <!-- Your submit button and other UI elements -->
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Submit Task
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
