<script setup>
import { Card } from '@/components/ui/card';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';

const technologies = ref([
    { id: 1, nom: 'HTML5', categorie: 'Frontend', niveau: 'Avancé' },
    { id: 2, nom: 'CSS3', categorie: 'Frontend', niveau: 'Avancé' },
    {
        id: 3,
        nom: 'JavaScript',
        categorie: 'Frontend',
        niveau: 'Intermédiaire',
    },
    { id: 4, nom: 'Vue.js', categorie: 'Frontend', niveau: 'Débutant' },
    { id: 5, nom: 'PHP', categorie: 'Backend', niveau: 'Intermédiaire' },
    { id: 6, nom: 'Laravel', categorie: 'Backend', niveau: 'Débutant' },
    { id: 7, nom: 'MySQL', categorie: 'Database', niveau: 'Intermédiaire' },
]);

const nouvelleTechnologie = ref({
    nom: '',
    categorie: '',
    niveau: '',
});
</script>

<template>
    <div class="p-8">
        <AppLayout>
            <h1 class="mt-8 mr-8 ml-8 text-4xl font-bold">Technologies</h1>

            <!-- Liste des technologies -->
            <div class="grid gap-6 p-8 md:grid-cols-2 lg:grid-cols-3">
                <Card
                    v-for="tech in technologies"
                    :key="tech.id"
                    class="flex flex-col justify-between rounded-lg border p-4 shadow-sm"
                >
                    <CardTitle class="mb-2 text-2xl font-semibold">{{
                        tech.nom
                    }}</CardTitle>
                    <CardDescription class="text-sm text-muted-foreground">
                        Catégorie: {{ tech.categorie }}
                    </CardDescription>
                    <CardDescription class="text-sm text-muted-foreground">
                        Niveau: {{ tech.niveau }}
                    </CardDescription>
                </Card>
            </div>
            <!--Formulaire ajout de technologies-->
            <form class="max-w-md rounded-lg border p-6 shadow-sm">
                <h2 class="mb-4 text-2xl font-semibold">
                    Ajouter une technologie
                </h2>
                <div class="mb-4">
                    <label class="mb-1 block font-medium" for="nom">Nom</label>
                    <input
                        v-model="nouvelleTechnologie.nom"
                        class="w-full rounded border px-3 py-2"
                        type="text"
                        id="nom"
                        placeholder="Nom de la technologie"
                    />
                </div>
                <div class="mb-4">
                    <label class="mb-1 block font-medium" for="categorie"
                        >Catégorie</label
                    >
                    <select
                        v-model="nouvelleTechnologie.categorie"
                        class="w-full rounded border px-3 py-2"
                        id="categorie"
                    >
                        <option value="" disabled>
                            Choisissez une catégorie
                        </option>
                        <option value="Frontend">Frontend</option>
                        <option value="Backend">Backend</option>
                        <option value="Database">Database</option>
                        <option value="DevOps">DevOps</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="mb-1 block font-medium" for="niveau"
                        >Niveau</label
                    >
                    <select
                        v-model="nouvelleTechnologie.niveau"
                        class="w-full rounded border px-3 py-2"
                        id="niveau"
                    >
                        <option value="" disabled>Choisissez un niveau</option>
                        <option value="Débutant">Débutant</option>
                        <option value="Intermédiaire">Intermédiaire</option>
                        <option value="Avancé">Avancé</option>
                    </select>
                </div>
                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    Ajouter
                </button>
            </form>
        </AppLayout>
    </div>
</template>
