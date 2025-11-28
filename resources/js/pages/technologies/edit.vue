<script setup>
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps(['technologie']);

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
    nom: props.technologie.nom,
    categorie: props.technologie.categorie,
    niveau: props.technologie.niveau,
});

// Technologies disponibles selon la catégorie sélectionnée
const availableTechnologies = computed(() => {
    if (!form.categorie) return [];
    return technologiesList[form.categorie] || [];
});

const submit = () => {
    form.put(`/technologies/${props.technologie.id}`, {
        onSuccess: () => {
            router.visit('/technologies');
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="p-8">
            <Button variant="outline" @click="router.visit('/technologies')">
                ← Retour aux technologies
            </Button>
        </div>
        <div class="mt-8 mr-8 ml-8">
            <h1 class="text-4xl font-bold">Modifier la technologie</h1>
            <p class="mt-2 text-lg text-gray-600">
                {{ props.technologie.nom }} ({{ props.technologie.categorie }})
            </p>
        </div>
        <!--Formulaire modification technologie-->
        <form
            @submit.prevent="submit"
            class="m-8 flex flex-col gap-4 rounded-lg border p-6 shadow-md"
        >
            <div>
                <label for="niveau" class="block font-medium">Niveau</label>
                <select
                    v-model="form.niveau"
                    id="niveau"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
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
            </div>
            <Button
                type="submit"
                :disabled="form.processing"
                class="mt-4 self-start"
                >Enregistrer</Button
            >
        </form>
    </AppLayout>
</template>
