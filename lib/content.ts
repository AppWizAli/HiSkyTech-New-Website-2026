export const navLinks = [
  { label: "About", href: "/#about" },
  { label: "Services", href: "/#services" },
  { label: "Projects", href: "/#work" },
  { label: "Process", href: "/#process" },
  { label: "Contact", href: "/#contact" },
] as const;

export const services = [
  {
    index: "01",
    icon: "⚡",
    title: "AI & Automation",
    description:
      "Intelligent automation systems designed to eliminate repetitive work, connect workflows, and improve operational efficiency.",
    bullets: [
      "Workflow Automation",
      "AI Agents",
      "API Integrations",
      "Business Process Automation",
      "CRM & Lead Automation",
      "Data Processing",
    ],
  },
  {
    index: "02",
    icon: "📞",
    title: "AI Calling Agents",
    description:
      "AI-powered voice agents that handle calls, qualify leads, answer questions, schedule appointments, and automate customer communication.",
    bullets: [
      "AI Voice Agents",
      "Appointment Booking",
      "Lead Qualification",
      "Customer Support",
      "Inbound & Outbound Calls",
      "CRM Integration",
    ],
  },
  {
    index: "03",
    icon: "📱",
    title: "Mobile App Development",
    description:
      "Modern mobile applications built around real business needs, intuitive experiences, and scalable technology.",
    bullets: [
      "iOS & Android Development",
      "Cross-Platform (React Native / Flutter)",
      "Offline-First Architecture",
      "Mobile AI & On-Device Models",
      "App Store & Play Store Deployment",
      "Push Notifications & Real-Time Sync",
    ],
  },
  {
    index: "04",
    icon: "🌐",
    title: "Web & Software Development",
    description:
      "High-performance websites, web applications, dashboards, and custom software built to support growing businesses.",
    bullets: [
      "Modern Frontends",
      "Responsive Websites",
      "Landing Pages",
      "Business Websites",
      "Interactive Experiences",
      "Performance Optimization",
    ],
  },
] as const;

/** Rendered into the about-section counter. Kept in sync with `services`. */
export const CORE_SERVICE_COUNT = services.length;

export const regions = [
  "Pakistan",
  "Middle East",
  "USA / Canada",
  "Europe",
  "United Kingdom",
  "Australia",
  "Asia",
  "Other",
] as const;

export const processSteps = [
  {
    index: "01",
    title: "Discover",
    description: "We understand the business, goals, users, and challenges.",
  },
  {
    index: "02",
    title: "Design",
    description: "We define the experience, architecture, and solution.",
  },
  {
    index: "03",
    title: "Build",
    description: "Our team develops, integrates, tests, and refines the product.",
  },
  {
    index: "04",
    title: "Launch",
    description: "We launch, measure, improve, and continue supporting the solution.",
  },
] as const;

export const principles = [
  {
    index: "01",
    title: "Business First",
    description:
      "Solutions should solve real business problems — not just look impressive.",
  },
  {
    index: "02",
    title: "AI-Focused",
    description: "Modern AI technologies are used where they actually provide value.",
  },
  {
    index: "03",
    title: "Clean Development",
    description: "Build with maintainability, performance, and scalability in mind.",
  },
  {
    index: "04",
    title: "Detail Driven",
    description:
      "Every interaction, spacing decision, animation, and component should feel intentional.",
  },
] as const;

export const team = [
  {
    name: "Ali Hamza",
    role: "AI & Automation Engineer",
    image: "/team/ali-hamza.webp",
  },
  {
    name: "Muhammad Ijaz",
    role: "Mobile App Developer",
    image: "/team/muhammad-ijaz.webp",
  },
  {
    name: "M Mubashir",
    role: "Website Developer",
    image: "/team/m-mubashir.png",
  },
  {
    name: "Huma Ali",
    role: "Graphic Designer",
    image: "/team/huma-ali-avatar.svg",
  },
] as const;

export const tools = [
  "JavaScript",
  "Next.js",
  "React.js",
  "TypeScript",
  "Tailwind CSS",
  "Framer Motion",
  "Python",
  "FastAPI",
  "PostgreSQL",
  "Supabase",
  "OpenAI Agents SDK",
  "n8n",
  "Retell",
  "Vapi",
  "Docker",
  "MCP",
  "RAG",
] as const;

export type Project = {
  id: string;
  category: string;
  title: string;
  previewLabel: string;
  previewType: "screenshot" | "image" | "voiceDemo" | "caseStudy";
  href?: string;
  image?: string;
  tags?: string[];
  description?: string;
  demoScript?: string;
  accent?: "amber" | "emerald" | "slate" | "rose" | "teal";
  /** Shown in place of a visit link. Used when the public URL is not live. */
  demo?: boolean;
};

export const workFilters = [
  "All Work",
  "AI Automation",
  "AI Calling Agents",
  "Mobile Apps",
  "Website Development",
] as const;

export const projects: Project[] = [
  {
    id: "xorvian",
    category: "AI Calling Agents",
    title: "Xorvian — AI Restaurant Agent",
    previewLabel: "Demo — live link unavailable",
    previewType: "caseStudy",
    accent: "teal",
    demo: true,
    tags: ["AI Voice Agent", "Restaurant", "Demo"],
    description:
      "A voice AI agent that answers every restaurant call, takes orders, books reservations, and syncs straight to the POS 24/7.",
  },
  {
    id: "content-engine",
    category: "AI Automation",
    title: "AI 30-Day Content Engine",
    previewLabel: "AI CONTENT ENGINE WORKFLOW",
    previewType: "image",
    image: "/projects/content-engine-workflow.png",
    tags: ["n8n", "AI Automation", "Content Engine"],
    description:
      "A fully automated content pipeline: enter a niche once, and AI plans, writes, illustrates, and publishes a month of on-brand social posts on autopilot.",
  },
  {
    id: "hospital-agent",
    category: "AI Calling Agents",
    title: "AI Hospital Agent",
    previewLabel: "AI HOSPITAL AGENT DEMO",
    previewType: "voiceDemo",
    image: "/projects/hospital-agent.jpg",
    demoScript:
      "Thank you for calling City General Hospital. I can help you schedule an appointment, check visiting hours, or connect you with a department. How can I help you today?",
  },
  {
    id: "dental-agent",
    category: "AI Calling Agents",
    title: "AI Dental Agent",
    previewLabel: "AI DENTAL AGENT DEMO",
    previewType: "voiceDemo",
    image: "/projects/dental-agent.jpg",
    demoScript:
      "Hi, thanks for calling Bright Smile Dental. I can help you book a cleaning, check your appointment time, or answer questions about our services. What can I do for you?",
  },
  {
    id: "jobcando",
    category: "Website Development",
    title: "JobCanDo",
    previewLabel: "Post a job, get real-time offers from local buddies",
    previewType: "screenshot",
    href: "https://jobcando.com/",
    tags: ["Next.js", "React", "Marketplace"],
    description:
      "A local services marketplace connecting job posters with verified buddies in real time.",
  },
  {
    id: "maxxify",
    category: "Website Development",
    title: "Maxxify Academy",
    previewLabel: "Pakistan's #1 platform for entrance exams",
    previewType: "screenshot",
    href: "https://www.maxxifyacademy.com/",
    tags: ["Next.js", "EdTech", "Dashboard"],
    description:
      "An MDCAT/NUMS/F.Sc exam-prep platform with AI quiz building, shortlisting tools, and student dashboards.",
  },
  {
    id: "sktechnical",
    category: "Website Development",
    title: "SK Technical Solutions",
    previewLabel: "Quality heating & air condition services",
    previewType: "screenshot",
    href: "https://sktechsolutions.net/",
    tags: ["Next.js", "Business Site", "Services"],
    description:
      "A service-business website for an HVAC & AC repair company, built for trust and fast lead capture.",
  },
  {
    id: "janud-dental",
    category: "Website Development",
    title: "Janud Dental Clinic",
    previewLabel: "Expert care, healthy smiles, happy lives",
    previewType: "screenshot",
    href: "https://januddentalclinic.online/",
    tags: ["Next.js", "Healthcare", "Booking"],
    description:
      "A booking-focused clinic website for Janud Dental Clinic in Sargodha, built around trust, services, and appointment conversion.",
  },
  {
    id: "aerie-clubs",
    category: "Website Development",
    title: "Aerie Clubs",
    previewLabel: "A World Beyond Compromise",
    previewType: "image",
    image: "/projects/aerie-clubs.webp",
    tags: ["HTML5", "CSS3", "JavaScript", "Bootstrap", "jQuery"],
    description:
      "A luxury, high-end website for Aerie Clubs, an exclusive global network of ultra-secure sanctuaries offering unparalleled privacy and personalized service.",
  },
  {
    id: "ben-energy",
    category: "Website Development",
    title: "Ben Energy",
    previewLabel: "Powering the Future, Today",
    previewType: "image",
    image: "/projects/ben-energy.webp",
    tags: ["HTML5", "CSS3", "JavaScript", "Bootstrap", "jQuery"],
    description:
      "A professional website for Ben Energy, a solar energy company offering renewable energy solutions for residential and commercial clients across Nigeria.",
  },
  {
    id: "consumer-legal-group",
    category: "Website Development",
    title: "Consumer Legal Group",
    previewLabel: "Let Us Fight For You",
    previewType: "image",
    image: "/projects/consumer-legal-group.png",
    tags: ["Webflow", "HTML5", "CSS3", "JavaScript", "Lottie Animations"],
    description:
      "A professional website for Consumer Legal Group, a New York-based law firm specializing in consumer debt relief and resolution.",
  },
  {
    id: "homez-buyers-advocacy",
    category: "Website Development",
    title: "Homez Buyers Advocacy",
    previewLabel: "Empowering You to Navigate the Property Market",
    previewType: "image",
    image: "/projects/homez-buyers-advocacy.webp",
    tags: ["Webflow", "HTML5", "CSS3", "JavaScript", "Swiper.js"],
    description:
      "A professional website for Homez Buyers Advocacy, a Sydney-based property buying service empowering clients with expert guidance and market insight.",
  },
  {
    id: "hairlichkeit",
    category: "Website Development",
    title: "Hairlichkeit",
    previewLabel: "Nie wieder rasieren oder wachsen",
    previewType: "image",
    image: "/projects/hairlichkeit.webp",
    href: "https://hairlichkeit.de/",
    tags: ["WordPress", "PHP", "MySQL", "Elementor", "CSS3"],
    description:
      "A professional WordPress website for Hairlichkeit, a laser hair removal studio in Frankfurt specializing in permanent, painless treatments.",
  },
];
