<script setup>
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps(['projet', 'technologies']);

const openProjectUrl = () => {
    window.open(props.projet.projet_url, '_blank');
};

const openGithubUrl = () => {
    window.open(props.projet.github_url, '_blank');
};
</script>

<template>
    <AppLayout>
        <div class="p-8">
            <div class="mb-6 flex gap-3">
                <Button variant="outline" @click="router.visit('/projets')">
                    ← Retour aux projets
                </Button>
                <Button
                    variant="outline"
                    @click="router.visit(`/projets/${projet.id}/edit`)"
                >
                    Modifier le projet
                </Button>
            </div>

            <div class="mx-auto max-w-5xl space-y-6">
                <!-- En-tête du projet -->
                <Card>
                    <CardHeader>
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <CardTitle class="mb-3 text-3xl">{{
                                    projet.titre
                                }}</CardTitle>
                                <p class="mb-4 text-lg text-muted-foreground">
                                    {{ projet.description_courte }}
                                </p>
                                <div class="flex gap-2">
                                    <Badge variant="secondary">{{
                                        projet.type
                                    }}</Badge>
                                    <Badge
                                        :variant="
                                            projet.statut === 'Terminé'
                                                ? 'default'
                                                : 'outline'
                                        "
                                    >
                                        {{ projet.statut }}
                                    </Badge>
                                </div>
                            </div>
                        </div>
                    </CardHeader>
                </Card>

                <!-- Description détaillée -->
                <Card v-if="projet.description_longue">
                    <CardHeader>
                        <CardTitle>Description détaillée</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div
                            class="prose prose-sm dark:prose-invert max-w-none"
                            v-html="projet.description_longue"
                        ></div>
                    </CardContent>
                </Card>

                <!-- Informations du projet -->
                <Card>
                    <CardHeader>
                        <CardTitle>Informations</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <p
                                    class="mb-1 text-sm font-medium text-muted-foreground"
                                >
                                    Client
                                </p>
                                <p class="text-base">{{ projet.client }}</p>
                            </div>
                            <div>
                                <p
                                    class="mb-1 text-sm font-medium text-muted-foreground"
                                >
                                    Date
                                </p>
                                <p class="text-base">
                                    {{
                                        new Date(
                                            projet.date,
                                        ).toLocaleDateString('fr-FR')
                                    }}
                                </p>
                            </div>
                            <div>
                                <p
                                    class="mb-1 text-sm font-medium text-muted-foreground"
                                >
                                    Contexte
                                </p>
                                <p class="text-base">{{ projet.contexte }}</p>
                            </div>
                            <div v-if="projet.duree">
                                <p
                                    class="mb-1 text-sm font-medium text-muted-foreground"
                                >
                                    Durée
                                </p>
                                <p class="text-base">{{ projet.duree }}</p>
                            </div>
                            <div v-if="projet.role" class="md:col-span-2">
                                <p
                                    class="mb-1 text-sm font-medium text-muted-foreground"
                                >
                                    Rôle
                                </p>
                                <p class="text-base">{{ projet.role }}</p>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                <!--Technologies-->
                <Card v-if="technologies.length">
                    <CardHeader>
                        <CardTitle>Technologies utilisées</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="flex flex-wrap gap-3">
                            <Badge
                                v-for="tech in technologies"
                                :key="tech.id"
                                variant="outline"
                            >
                                {{ tech.nom }}
                            </Badge>
                        </div>
                    </CardContent>
                </Card>

                <!-- Liens -->
                <Card>
                    <CardHeader>
                        <CardTitle>Liens</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="flex flex-wrap gap-3">
                            <Button
                                v-if="projet.projet_url"
                                @click="openProjectUrl"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="mr-2 h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"
                                    />
                                    <polyline points="15 3 21 3 21 9" />
                                    <line x1="10" y1="14" x2="21" y2="3" />
                                </svg>
                                Voir le projet
                            </Button>
                            <Button
                                v-if="projet.github_url"
                                variant="outline"
                                @click="openGithubUrl"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="mr-2 h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"
                                    />
                                </svg>
                                Voir sur GitHub
                            </Button>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
