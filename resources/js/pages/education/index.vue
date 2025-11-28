<script setup>
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import AppLayout from '@/layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import Editor from '@tinymce/tinymce-vue';
import { ref } from 'vue';

defineProps(['educations']);

const form = useForm({
    diplome: '',
    etablissement: '',
    date_obtention: '',
    description: '',
});

const submit = () => {
    form.post('/education', {
        onSuccess: () => form.reset(),
    });
};

const deleteDialog = ref(false);
const educToDelete = ref(null);

const openDeleteDialog = (educ) => {
    educToDelete.value = educ;
    deleteDialog.value = true;
};

const deleteEducation = () => {
    if (educToDelete.value) {
        router.delete(`/education/${educToDelete.value.id}`, {
            onSuccess: () => {
                deleteDialog.value = false;
                educToDelete.value = null;
            },
        });
    }
};
</script>
<template>
    <AppLayout>
        <div class="mt-8 mr-8 ml-8 flex items-center justify-between">
            <h1 class="text-4xl font-bold">Mon éducation</h1>
        </div>
        <!--Formulaire ajout éducation-->
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
                            'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                        tinycomments_mode: 'embedded',
                        tinycomments_author: 'Author name',
                        mergetags_list: [
                            {
                                value: 'First.Name',
                                title: 'First Name',
                            },
                            { value: 'Email', title: 'Email' },
                        ],
                        ai_request: (request, respondWith) =>
                            respondWith.string(() =>
                                Promise.reject(
                                    'See docs to implement AI Assistant',
                                ),
                            ),
                        uploadcare_public_key: '414eacce1c7ebfa403f5',
                    }"
                    initial-value="Détaillez votre projet ici..."
                />
            </div>
            <button
                type="submit"
                class="self-end rounded bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700"
            >
                Ajouter l'éducation
            </button>
        </form>
        <!--Liste des éducations-->
        <div class="grid gap-6 p-8 md:grid-cols-2 lg:grid-cols-3">
            <Card
                v-for="educ in educations"
                :key="educ.id"
                class="transition-shadow hover:shadow-lg"
            >
                <CardHeader>
                    <CardTitle
                        class="cursor-pointer"
                        @click="router.visit(`/education/${educ.id}/edit`)"
                        >{{ educ.diplome }}</CardTitle
                    >
                </CardHeader>
                <CardContent>
                    <p>{{ educ.etablissement }}</p>
                    <p>{{ educ.date_obtention || 'Présent' }}</p>
                    <div v-html="educ.description"></div>
                </CardContent>
                <Button variant="destructive" @click="openDeleteDialog(educ)">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mr-2 h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                        />
                    </svg>
                    Supprimer
                </Button>
            </Card>
        </div>
        <!-- Dialog de confirmation de suppression -->
        <Dialog v-model:open="deleteDialog">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Confirmer la suppression</DialogTitle>
                    <DialogDescription>
                        Êtes-vous sûr de vouloir supprimer "{{
                            educToDelete?.diplome
                        }}" ? Cette action est irréversible.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button variant="outline" @click="deleteDialog = false">
                        Annuler
                    </Button>
                    <Button variant="destructive" @click="deleteEducation">
                        Supprimer
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
