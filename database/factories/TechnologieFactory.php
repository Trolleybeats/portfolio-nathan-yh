<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technologie>
 */
class TechnologieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $technologies = [
            'Frontend' => [
                'HTML5', 'CSS3', 'JavaScript', 'TypeScript',
                'React', 'Vue.js', 'Angular', 'Svelte', 'Next.js', 'Nuxt.js',
                'jQuery', 'Bootstrap', 'Tailwind CSS', 'Material-UI', 'Sass', 'Less',
                'Webpack', 'Vite', 'Parcel', 'Gulp', 'Ember.js', 'Backbone.js',
                'Alpine.js', 'Solid.js', 'Preact', 'Astro', 'Redux', 'Vuex', 'Pinia',
                'React Query', 'SWR', 'Remix'
            ],
            'Backend' => [
                'PHP', 'Laravel', 'Symfony', 'CodeIgniter', 'Slim',
                'Node.js', 'Express.js', 'NestJS', 'Fastify', 'Koa',
                'Python', 'Django', 'Flask', 'FastAPI', 'Pyramid',
                'Java', 'Spring Boot', 'Hibernate', 'Jakarta EE',
                'C#', '.NET', 'ASP.NET Core', 'Entity Framework',
                'Ruby', 'Ruby on Rails', 'Sinatra',
                'Go', 'Gin', 'Echo', 'Fiber',
                'Rust', 'Actix', 'Rocket',
                'Elixir', 'Phoenix',
                'Kotlin', 'Ktor'
            ],
            'Database' => [
                'MySQL', 'PostgreSQL', 'MariaDB', 'SQLite',
                'MongoDB', 'CouchDB', 'Cassandra', 'DynamoDB',
                'Redis', 'Memcached',
                'Elasticsearch', 'Solr',
                'Oracle', 'Microsoft SQL Server', 'IBM DB2',
                'Firebase Firestore', 'Supabase',
                'Neo4j', 'ArangoDB', 'OrientDB',
                'InfluxDB', 'TimescaleDB',
                'Amazon RDS', 'Amazon Aurora', 'Google Cloud SQL'
            ],
            'DevOps' => [
                'Docker', 'Kubernetes', 'Docker Compose', 'Podman',
                'Jenkins', 'GitLab CI', 'GitHub Actions', 'CircleCI', 'Travis CI',
                'Terraform', 'Ansible', 'Puppet', 'Chef', 'SaltStack',
                'AWS', 'Azure', 'Google Cloud Platform', 'DigitalOcean', 'Heroku',
                'Nginx', 'Apache', 'Caddy', 'Traefik',
                'Git', 'GitHub', 'GitLab', 'Bitbucket',
                'Prometheus', 'Grafana', 'ELK Stack', 'Datadog', 'New Relic',
                'Vagrant', 'Helm', 'ArgoCD', 'Flux'
            ]
        ];

        $categorie = $this->faker->randomElement(array_keys($technologies));
        
        return [
            'nom' => $this->faker->randomElement($technologies[$categorie]),
            'categorie' => $categorie,
            'niveau' => $this->faker->randomElement(['Débutant', 'Intermédiaire', 'Avancé']),
            'ordre_affichage' => $this->faker->numberBetween(1, 100),
        ];
    }
}
