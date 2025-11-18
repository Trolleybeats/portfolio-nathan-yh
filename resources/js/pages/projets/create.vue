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
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    titre: '',
    slug: '',
    description_courte: '',
    description_longue: '',
    type: '',
    statut: '',
    date: '',
    client: '',
    contexte: '',
    duree: '',
    role: '',
    projet_url: '',
    github_url: '',
    ordre_affichage: 1,
});

const submit = () => {
    form.post('/projets', {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout>
        <div class="p-8">
            <Card class="mx-auto max-w-2xl">
                <CardHeader>
                    <CardTitle>Créer un nouveau projet</CardTitle>
                    <CardDescription>
                        Remplissez le formulaire pour ajouter un nouveau projet
                        à votre portfolio.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <form @submit.prevent="submit" class="space-y-6">
                        <!--Titre-->
                        <div>
                            <Label for="titre"> Titre du projet </Label>
                            <Input
                                v-model="form.titre"
                                type="text"
                                id="titre"
                                placeholder="Mon super projet"
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.titre"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.titre }}
                            </p>
                        </div>

                        <!--Slug-->
                        <div>
                            <Label for="slug"> Slug (URL) </Label>
                            <Input
                                v-model="form.slug"
                                type="text"
                                id="slug"
                                placeholder="mon-super-projet"
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.slug"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.slug }}
                            </p>
                        </div>

                        <!--Description courte-->
                        <div>
                            <Label for="description_courte">
                                Description courte
                            </Label>
                            <Input
                                v-model="form.description_courte"
                                type="text"
                                id="description_courte"
                                placeholder="Une brève description du projet"
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.description_courte"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.description_courte }}
                            </p>
                        </div>

                        <!--Type-->
                        <div>
                            <Label for="type"> Type </Label>
                            <Input
                                v-model="form.type"
                                type="text"
                                id="type"
                                placeholder="Web, Mobile, Desktop..."
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.type"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.type }}
                            </p>
                        </div>

                        <!--Statut-->
                        <div>
                            <Label for="statut"> Statut </Label>
                            <Input
                                v-model="form.statut"
                                type="text"
                                id="statut"
                                placeholder="En cours, Terminé..."
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.statut"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.statut }}
                            </p>
                        </div>

                        <!--Date-->
                        <div>
                            <Label for="date"> Date </Label>
                            <Input
                                v-model="form.date"
                                type="date"
                                id="date"
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.date"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.date }}
                            </p>
                        </div>

                        <!--Client-->
                        <div>
                            <Label for="client"> Client </Label>
                            <Input
                                v-model="form.client"
                                type="text"
                                id="client"
                                placeholder="Nom du client"
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.client"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.client }}
                            </p>
                        </div>

                        <!--Contexte-->
                        <div>
                            <Label for="contexte"> Contexte </Label>
                            <Input
                                v-model="form.contexte"
                                type="text"
                                id="contexte"
                                placeholder="Contexte du projet"
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.contexte"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.contexte }}
                            </p>
                        </div>

                        <!--URL du projet-->
                        <div>
                            <Label for="projet_url"> URL du projet </Label>
                            <Input
                                v-model="form.projet_url"
                                type="url"
                                id="projet_url"
                                placeholder="https://example.com"
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.projet_url"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.projet_url }}
                            </p>
                        </div>

                        <!--URL GitHub-->
                        <div>
                            <Label for="github_url"> URL GitHub </Label>
                            <Input
                                v-model="form.github_url"
                                type="url"
                                id="github_url"
                                placeholder="https://github.com/username/repository"
                                class="mt-1"
                            />
                            <p
                                v-if="form.errors.github_url"
                                class="mt-1 text-sm text-destructive"
                            >
                                {{ form.errors.github_url }}
                            </p>
                        </div>

                        <!--Description longue-->
                        <!--Wiziwig-->

                        <!--Boutons-->
                        <div class="flex justify-end gap-4">
                            <Button
                                type="button"
                                variant="outline"
                                @click="$inertia.visit('/projets')"
                            >
                                Annuler
                            </Button>
                            <Button type="submit" :disabled="form.processing">
                                {{
                                    form.processing
                                        ? 'Création...'
                                        : 'Créer le projet'
                                }}
                            </Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
