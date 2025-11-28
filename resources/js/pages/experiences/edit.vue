<script setup>
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import Editor from '@tinymce/tinymce-vue';

const props = defineProps(['experience']);

const form = useForm({
    poste: props.experience.poste,
    entreprise: props.experience.entreprise,
    lieu: props.experience.lieu,
    type: props.experience.type,
    date_debut: props.experience.date_debut,
    date_fin: props.experience.date_fin,
    description: props.experience.description,
});

const submit = () => {
    form.put(`/experiences/${props.experience.id}`, {
        onSuccess: () => {
            router.visit('/experiences');
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="p-8">
            <Button variant="outline" @click="router.visit('/experiences')">
                ← Retour aux expériences
            </Button>
        </div>
        <div class="mt-8 mr-8 ml-8 flex items-center justify-between">
            <h1 class="text-4xl font-bold">Modifier l'expérience</h1>
        </div>
        <!--Formulaire modification expérience-->
        <form
            @submit.prevent="submit"
            class="m-8 flex flex-col gap-4 rounded-lg border p-6 shadow-md"
        >
            <div>
                <label for="poste" class="block font-medium">Poste</label>
                <input
                    v-model="form.poste"
                    type="text"
                    id="poste"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="entreprise" class="block font-medium"
                    >Entreprise</label
                >
                <input
                    v-model="form.entreprise"
                    type="text"
                    id="entreprise"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="lieu" class="block font-medium">Lieu</label>
                <input
                    v-model="form.lieu"
                    type="text"
                    id="lieu"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="type" class="block font-medium">Type</label>
                <select
                    v-model="form.type"
                    id="type"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                >
                    <option value="Stage">Stage</option>
                    <option value="Emploi">Emploi</option>
                    <option value="Freelance">Freelance</option>
                </select>
            </div>
            <div>
                <label for="date_debut" class="block font-medium"
                    >Date de début</label
                >
                <input
                    v-model="form.date_debut"
                    type="date"
                    id="date_debut"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="date_fin" class="block font-medium"
                    >Date de fin</label
                >
                <input
                    v-model="form.date_fin"
                    type="date"
                    id="date_fin"
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
                        toolbar_mode: 'sliding',
                        plugins: [
                            // Core editing features
                            'anchor',
                            'autolink',
                            'charmap',
                            'codesample',
                            'emoticons',
                            'link',
                            'lists',
                            'media',
                            'searchreplace',
                            'table',
                            'visualblocks',
                            'wordcount',
                        ],
                        toolbar:
                            'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link media',
                    }"
                ></Editor>
            </div>
            <Button
                type="submit"
                class="mt-4 self-start"
                :disabled="form.processing"
                >Enregistrer</Button
            >
        </form>
    </AppLayout>
</template>
