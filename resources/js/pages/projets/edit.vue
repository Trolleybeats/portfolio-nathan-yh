<script setup>
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import Editor from '@tinymce/tinymce-vue';

const props = defineProps(['projet']);

const form = useForm({
    titre: props.projet.titre,
    slug: props.projet.slug,
    description_courte: props.projet.description_courte,
    description_longue: props.projet.description_longue,
    type: props.projet.type,
    statut: props.projet.statut,
    date: props.projet.date,
    client: props.projet.client,
    contexte: props.projet.contexte,
    duree: props.projet.duree || '',
    role: props.projet.role || '',
    projet_url: props.projet.projet_url,
    github_url: props.projet.github_url || '',
    ordre_affichage: props.projet.ordre_affichage,
});

const submit = () => {
    form.put(`/projets/${props.projet.id}`, {
        onSuccess: () => {
            router.visit(`/projets/${props.projet.id}`);
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="p-8">
            <Button
                variant="outline"
                class="mb-6"
                @click="router.visit('/projets')"
            >
                ← Retour aux projets
            </Button>

            <div class="mx-auto max-w-6xl space-y-6">
                <!-- Formulaire d'édition du projet -->
                <Card>
                    <CardHeader>
                        <CardTitle>Modifier le projet</CardTitle>
                        <CardDescription
                            >Modifiez les informations de votre
                            projet</CardDescription
                        >
                    </CardHeader>
                    <CardContent>
                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <!-- Titre -->
                                <div>
                                    <Label for="titre">Titre du projet</Label>
                                    <Input
                                        v-model="form.titre"
                                        type="text"
                                        id="titre"
                                        class="mt-1"
                                    />
                                    <p
                                        v-if="form.errors.titre"
                                        class="mt-1 text-sm text-destructive"
                                    >
                                        {{ form.errors.titre }}
                                    </p>
                                </div>

                                <!-- Slug -->
                                <div>
                                    <Label for="slug">Slug (URL)</Label>
                                    <Input
                                        v-model="form.slug"
                                        type="text"
                                        id="slug"
                                        class="mt-1"
                                    />
                                    <p
                                        v-if="form.errors.slug"
                                        class="mt-1 text-sm text-destructive"
                                    >
                                        {{ form.errors.slug }}
                                    </p>
                                </div>

                                <!-- Type -->
                                <div>
                                    <Label for="type">Type</Label>
                                    <select
                                        v-model="form.type"
                                        id="type"
                                        class="mt-1 block w-full rounded-md border border-input bg-background px-3 py-2"
                                    >
                                        <option value="Web">Web</option>
                                        <option value="Mobile">Mobile</option>
                                        <option value="API">API</option>
                                        <option value="Design">Design</option>
                                    </select>
                                </div>

                                <!-- Statut -->
                                <div>
                                    <Label for="statut">Statut</Label>
                                    <select
                                        v-model="form.statut"
                                        id="statut"
                                        class="mt-1 block w-full rounded-md border border-input bg-background px-3 py-2"
                                    >
                                        <option value="Brouillon">
                                            Brouillon
                                        </option>
                                        <option value="Publié">Publié</option>
                                        <option value="Archivé">Archivé</option>
                                    </select>
                                </div>

                                <!-- Date -->
                                <div>
                                    <Label for="date">Date</Label>
                                    <Input
                                        v-model="form.date"
                                        type="date"
                                        id="date"
                                        class="mt-1"
                                    />
                                </div>

                                <!-- Client -->
                                <div>
                                    <Label for="client">Client</Label>
                                    <Input
                                        v-model="form.client"
                                        type="text"
                                        id="client"
                                        class="mt-1"
                                    />
                                </div>

                                <!-- Contexte -->
                                <div class="md:col-span-2">
                                    <Label for="contexte">Contexte</Label>
                                    <Input
                                        v-model="form.contexte"
                                        type="text"
                                        id="contexte"
                                        class="mt-1"
                                    />
                                </div>

                                <!-- URL du projet -->
                                <div>
                                    <Label for="projet_url"
                                        >URL du projet</Label
                                    >
                                    <Input
                                        v-model="form.projet_url"
                                        type="url"
                                        id="projet_url"
                                        class="mt-1"
                                    />
                                </div>

                                <!-- URL GitHub -->
                                <div>
                                    <Label for="github_url"
                                        >URL GitHub (optionnel)</Label
                                    >
                                    <Input
                                        v-model="form.github_url"
                                        type="url"
                                        id="github_url"
                                        class="mt-1"
                                    />
                                </div>
                            </div>

                            <!-- Description courte -->
                            <div>
                                <Label for="description_courte"
                                    >Description courte</Label
                                >
                                <Input
                                    v-model="form.description_courte"
                                    type="text"
                                    id="description_courte"
                                    class="mt-1"
                                />
                                <p
                                    v-if="form.errors.description_courte"
                                    class="mt-1 text-sm text-destructive"
                                >
                                    {{ form.errors.description_courte }}
                                </p>
                            </div>

                            <!-- Description longue -->
                            <div>
                                <Label for="description_longue"
                                    >Description détaillée</Label
                                >
                                <Editor
                                    v-model="form.description_longue"
                                    api-key="oig375edhy4phcrai14yp7jp8xgoy7f64p2of2nzig0vm246"
                                    :init="{
                                        height: 400,
                                        menubar: false,
                                        plugins: [
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
                                            'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                    }"
                                />
                            </div>

                            <!-- Boutons -->
                            <div class="flex justify-end gap-4">
                                <Button
                                    type="button"
                                    variant="outline"
                                    @click="
                                        router.visit(`/projets/${projet.id}`)
                                    "
                                >
                                    Annuler
                                </Button>
                                <Button
                                    type="submit"
                                    :disabled="form.processing"
                                >
                                    {{
                                        form.processing
                                            ? 'Enregistrement...'
                                            : 'Enregistrer les modifications'
                                    }}
                                </Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
