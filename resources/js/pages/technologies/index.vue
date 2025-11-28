<script setup>
import { Button } from '@/components/ui/button';
import { Card } from '@/components/ui/card';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
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
import { computed, ref } from 'vue';

defineProps(['technologies']);

const deleteDialog = ref(false);
const techToDelete = ref(null);

const technologiesList = {
    Frontend: [
        'HTML5',
        'CSS3',
        'JavaScript',
        'TypeScript',
        'React',
        'Vue.js',
        'Angular',
        'Svelte',
        'Next.js',
        'Nuxt.js',
        'jQuery',
        'Bootstrap',
        'Tailwind CSS',
        'Material-UI',
        'Sass',
        'Less',
        'Webpack',
        'Vite',
        'Parcel',
        'Gulp',
        'Ember.js',
        'Backbone.js',
        'Alpine.js',
        'Solid.js',
        'Preact',
        'Astro',
        'Redux',
        'Vuex',
        'Pinia',
        'React Query',
        'SWR',
        'Remix',
    ],
    Backend: [
        'PHP',
        'Laravel',
        'Symfony',
        'CodeIgniter',
        'Slim',
        'Node.js',
        'Express.js',
        'NestJS',
        'Fastify',
        'Koa',
        'Python',
        'Django',
        'Flask',
        'FastAPI',
        'Pyramid',
        'Java',
        'Spring Boot',
        'Hibernate',
        'Jakarta EE',
        'C#',
        '.NET',
        'ASP.NET Core',
        'Entity Framework',
        'Ruby',
        'Ruby on Rails',
        'Sinatra',
        'Go',
        'Gin',
        'Echo',
        'Fiber',
        'Rust',
        'Actix',
        'Rocket',
        'Elixir',
        'Phoenix',
        'Kotlin',
        'Ktor',
    ],
    Database: [
        'MySQL',
        'PostgreSQL',
        'MariaDB',
        'SQLite',
        'MongoDB',
        'CouchDB',
        'Cassandra',
        'DynamoDB',
        'Redis',
        'Memcached',
        'Elasticsearch',
        'Solr',
        'Oracle',
        'Microsoft SQL Server',
        'IBM DB2',
        'Firebase Firestore',
        'Supabase',
        'Neo4j',
        'ArangoDB',
        'OrientDB',
        'InfluxDB',
        'TimescaleDB',
        'Amazon RDS',
        'Amazon Aurora',
        'Google Cloud SQL',
    ],
    DevOps: [
        'Docker',
        'Kubernetes',
        'Docker Compose',
        'Podman',
        'Jenkins',
        'GitLab CI',
        'GitHub Actions',
        'CircleCI',
        'Travis CI',
        'Terraform',
        'Ansible',
        'Puppet',
        'Chef',
        'SaltStack',
        'AWS',
        'Azure',
        'Google Cloud Platform',
        'DigitalOcean',
        'Heroku',
        'Nginx',
        'Apache',
        'Caddy',
        'Traefik',
        'Git',
        'GitHub',
        'GitLab',
        'Bitbucket',
        'Prometheus',
        'Grafana',
        'ELK Stack',
        'Datadog',
        'New Relic',
        'Vagrant',
        'Helm',
        'ArgoCD',
        'Flux',
    ],
};

const categories = Object.keys(technologiesList);
const niveaux = ['Débutant', 'Intermédiaire', 'Avancé'];

const form = useForm({
    nom: '',
    categorie: '',
    niveau: '',
});

// Technologies disponibles selon la catégorie sélectionnée
const availableTechnologies = computed(() => {
    if (!form.categorie) return [];
    return technologiesList[form.categorie] || [];
});

const submit = () => {
    form.post('/technologies', {
        onSuccess: () => form.reset(),
    });
};

const openDeleteDialog = (tech) => {
    techToDelete.value = tech;
    deleteDialog.value = true;
};

const deleteTech = () => {
    if (techToDelete.value) {
        router.delete(`/technologies/${techToDelete.value.id}`, {
            onSuccess: () => {
                deleteDialog.value = false;
                techToDelete.value = null;
            },
        });
    }
};
</script>

<template>
    <div class="p-8">
        <AppLayout>
            <h1 class="mt-8 mr-8 ml-8 text-4xl font-bold">Technologies</h1>
            <!--Formulaire ajout de technologies-->
            <form
                @submit.prevent="submit"
                class="mt-8 mr-8 ml-8 max-w-full rounded-lg border p-6 shadow-sm"
            >
                <h2 class="mb-4 text-2xl font-semibold">
                    Ajouter une technologie
                </h2>

                <!-- Catégorie -->
                <div class="mb-4">
                    <label class="mb-1 block font-medium" for="categorie"
                        >Catégorie</label
                    >
                    <select
                        v-model="form.categorie"
                        class="w-full rounded border px-3 py-2"
                        id="categorie"
                    >
                        <option value="" disabled>
                            Choisissez une catégorie
                        </option>
                        <option
                            v-for="cat in categories"
                            :key="cat"
                            :value="cat"
                        >
                            {{ cat }}
                        </option>
                    </select>
                    <p
                        v-if="form.errors.categorie"
                        class="mt-1 text-sm text-destructive"
                    >
                        {{ form.errors.categorie }}
                    </p>
                </div>

                <!-- Nom de la technologie -->
                <div class="mb-4">
                    <label class="mb-1 block font-medium" for="nom"
                        >Technologie</label
                    >
                    <select
                        v-model="form.nom"
                        class="w-full rounded border px-3 py-2"
                        id="nom"
                        :disabled="!form.categorie"
                    >
                        <option value="" disabled>
                            {{
                                form.categorie
                                    ? 'Choisissez une technologie'
                                    : "Sélectionnez d'abord une catégorie"
                            }}
                        </option>
                        <option
                            v-for="tech in availableTechnologies"
                            :key="tech"
                            :value="tech"
                        >
                            {{ tech }}
                        </option>
                    </select>
                    <p
                        v-if="form.errors.nom"
                        class="mt-1 text-sm text-destructive"
                    >
                        {{ form.errors.nom }}
                    </p>
                </div>

                <!-- Niveau -->
                <div class="mb-4">
                    <label class="mb-1 block font-medium" for="niveau"
                        >Niveau</label
                    >
                    <select
                        v-model="form.niveau"
                        class="w-full rounded border px-3 py-2"
                        id="niveau"
                    >
                        <option value="" disabled>Choisissez un niveau</option>
                        <option
                            v-for="niveau in niveaux"
                            :key="niveau"
                            :value="niveau"
                        >
                            {{ niveau }}
                        </option>
                    </select>
                    <p
                        v-if="form.errors.niveau"
                        class="mt-1 text-sm text-destructive"
                    >
                        {{ form.errors.niveau }}
                    </p>
                </div>
                <Button type="submit" :disabled="form.processing">
                    {{ form.processing ? 'Ajout...' : 'Ajouter' }}
                </Button>
            </form>

            <!-- Liste des technologies -->
            <div class="grid gap-6 p-8 md:grid-cols-2 lg:grid-cols-3">
                <Card
                    v-for="tech in technologies"
                    :key="tech.id"
                    class="flex flex-col justify-between rounded-lg border p-4 shadow-sm"
                >
                    <CardTitle
                        class="mb-2 cursor-pointer text-2xl font-semibold"
                        @click="router.visit(`/technologies/${tech.id}/edit`)"
                        >{{ tech.nom }}</CardTitle
                    >
                    <CardDescription class="text-sm text-muted-foreground">
                        Catégorie: {{ tech.categorie }}
                    </CardDescription>
                    <CardDescription class="text-sm text-muted-foreground">
                        Niveau: {{ tech.niveau }}
                    </CardDescription>
                    <Button
                        type="button"
                        variant="destructive"
                        @click="openDeleteDialog(tech)"
                    >
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
                                techToDelete?.nom
                            }}" ? Cette action est irréversible.
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter>
                        <Button variant="outline" @click="deleteDialog = false">
                            Annuler
                        </Button>
                        <Button variant="destructive" @click="deleteTech">
                            Supprimer
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </AppLayout>
    </div>
</template>
