<script setup>
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import Editor from '@tinymce/tinymce-vue';

const props = defineProps(['education']);

const form = useForm({
    diplome: props.education.diplome,
    etablissement: props.education.etablissement,
    date_obtention: props.education.date_obtention,
    description: props.education.description,
});

const submit = () => {
    form.put(`/education/${props.education.id}`, {
        onSuccess: () => {
            router.visit('/education');
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="p-8">
            <Button variant="outline" @click="router.visit('/education')">
                ← Retour à l'éducation
            </Button>
        </div>
        <div class="mt-8 mr-8 ml-8 flex items-center justify-between">
            <h1 class="text-4xl font-bold">Modifier l'éducation</h1>
        </div>
        <!--Formulaire modification éducation-->
        <form
            @submit.prevent="submit"
            class="m-8 flex flex-col gap-4 rounded-lg border p-6 shadow-md"
        >
            <div>
                <label for="diplome" class="block font-medium">Diplôme</label>
                <input
                    v-model="form.diplome"
                    type="text"
                    id="diplome"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="etablissement" class="block font-medium"
                    >Établissement</label
                >
                <input
                    v-model="form.etablissement"
                    type="text"
                    id="etablissement"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="date_obtention" class="block font-medium"
                    >Date d'obtention</label
                >
                <input
                    v-model="form.date_obtention"
                    type="date"
                    id="date_obtention"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="description" class="block font-medium"
                    >Description</label
                >
                <Editor
                    v-model="form.description"
                    api-key="oig375edhy4phcrai14yp7jp8xgoy7f64p2of2nzig0vm246"
                    id="description"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                    :init="{
                        height: 300,
                        menubar: false,
                        plugins: [
                            'advlist autolink lists link charmap print preview anchor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media table paste code help wordcount',
                        ],
                        toolbar:
                            'undo redo | formatselect | bold italic backcolor | \
                            alignleft aligncenter alignright alignjustify | \
                            bullist numlist outdent indent | removeformat | help',
                    }"
                ></Editor>
            </div>
            <Button
                type="submit"
                :disabled="form.processing"
                class="mt-4 self-start"
            >
                Enregistrer les modifications
            </Button>
        </form>
    </AppLayout>
</template>
