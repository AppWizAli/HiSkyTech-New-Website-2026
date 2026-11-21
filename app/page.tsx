import Image from "next/image";
import Link from "next/link";
import { BookCallButton, ContactMethods } from "@/components/ContactMethods";
import { Counter } from "@/components/Counter";
import { Hero } from "@/components/Hero";
import { Reveal, StaggerGroup, StaggerItem } from "@/components/Reveal";
import { SelectedWork } from "@/components/SelectedWork";
import { SocialLinks } from "@/components/SocialLinks";
import {
  CORE_SERVICE_COUNT,
  principles,
  processSteps,
  services,
  team,
  tools,
} from "@/lib/content";

function Divider() {
  return (
    <div className="w-full flex items-center justify-center py-6 px-4 pointer-events-none">
      <div className="w-full max-w-6xl section-divider" />
    </div>
  );
}

export default function HomePage() {
  return (
    <main>
      <Hero />
      <Divider />
      <section className="py-24 border-b border-white/[0.05]" id="about">
        <div className="max-w-7xl mx-auto px-6">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <Reveal className="lg:col-span-5">
              <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-3">
                About
              </span>
              <h2 className="text-3xl sm:text-4xl font-bold tracking-tight text-white leading-tight">
                Building With AI.
                <br />
                Creating With Purpose.
              </h2>
            </Reveal>
            <div className="lg:col-span-7 space-y-10">
              <Reveal delay={0.1}>
                <p className="text-neutral-400 text-sm sm:text-base leading-relaxed">
                  <span className="text-white font-semibold">HiSkyTech</span> builds modern digital
                  products, intelligent automation systems, and scalable software solutions that help
                  businesses work smarter and grow faster. We work across four connected
                  disciplines: automating the workflows that slow teams down, building AI calling
                  agents that hold real conversations with customers, and developing modern websites
                  and mobile applications that give both of those systems a home. Every project
                  starts with a business problem, not a piece of technology — AI is a tool we reach
                  for when it genuinely makes something faster, smarter, or more useful.
                </p>
              </Reveal>
              <StaggerGroup className="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 border-t border-white/[0.08]">
                <StaggerItem className="p-4 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                  <div className="text-xl sm:text-2xl font-bold text-white font-mono">2024</div>
                  <div className="text-xs text-neutral-400 mt-1">Since</div>
                </StaggerItem>
                <StaggerItem className="p-4 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                  <div className="text-2xl sm:text-3xl font-bold text-white font-mono">
                    <Counter target={CORE_SERVICE_COUNT} />
                  </div>
                  <div className="text-xs text-neutral-400 mt-1">Core Services</div>
                </StaggerItem>
                <StaggerItem className="p-4 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                  <div className="text-xl sm:text-2xl font-bold text-white font-mono">AI-First</div>
                  <div className="text-xs text-neutral-400 mt-1">Approach</div>
                </StaggerItem>
                <StaggerItem className="p-4 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                  <div className="text-xl sm:text-2xl font-bold text-white font-mono">End-to-End</div>
                  <div className="text-xs text-neutral-400 mt-1">Development</div>
                </StaggerItem>
              </StaggerGroup>
            </div>
          </div>
        </div>
      </section>
      <Divider />
      <section className="py-24 border-b border-white/[0.05] relative" id="services">
        <div className="max-w-7xl mx-auto px-6">
          <Reveal className="mb-14">
            <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-2">
              What We Build
            </span>
            <h2 className="text-3xl sm:text-4xl font-bold tracking-tight text-white">
              Four disciplines. One
              <br />
              connected system.
            </h2>
          </Reveal>
          <StaggerGroup className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" stagger={0.12}>
            {services.map((service) => (
              <StaggerItem key={service.title}>
                <div className="hairline-card hairline-card-glow p-6 sm:p-7 flex flex-col justify-between h-full">
                  <div>
                    <div className="flex items-center justify-between mb-5">
                      <span className="text-xs font-mono text-neutral-500">{service.index}</span>
                      <span className="w-8 h-8 rounded-full bg-blue-500/10 text-blue-400 flex items-center justify-center text-xs">
                        {service.icon}
                      </span>
                    </div>
                    <h3 className="text-lg font-bold text-white mb-2.5">{service.title}</h3>
                    <p className="text-xs sm:text-sm text-neutral-400 leading-relaxed mb-6">
                      {service.description}
                    </p>
                    <ul className="space-y-2 mb-8 text-xs text-neutral-300">
                      {service.bullets.map((bullet) => (
                        <li key={bullet} className="flex items-center gap-2">
                          <span className="text-neutral-500">•</span> {bullet}
                        </li>
                      ))}
                    </ul>
                  </div>
                  <a
                    className="text-xs font-medium text-neutral-300 hover:text-white flex items-center gap-1.5 transition-colors group"
                    href="#contact"
                  >
                    <span>Explore Service</span>
                    <span className="group-hover:translate-x-1 transition-transform">→</span>
                  </a>
                </div>
              </StaggerItem>
            ))}
          </StaggerGroup>
        </div>
      </section>
      <Divider />
      <SelectedWork />
      <Divider />
      <section className="py-24 border-b border-white/[0.05]" id="process">
        <div className="max-w-7xl mx-auto px-6">
          <Reveal className="mb-14">
            <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-2">
              How We Work
            </span>
            <h2 className="text-3xl sm:text-4xl font-bold tracking-tight text-white">
              A straightforward
              <br />
              process, start to finish.
            </h2>
          </Reveal>
          <StaggerGroup
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative"
            stagger={0.15}
          >
            {processSteps.map((step) => (
              <StaggerItem key={step.index} className="relative">
                <span className="text-xs font-mono text-neutral-500 mb-3 block">{step.index}</span>
                <div className="w-full h-px bg-white/10 mb-6 relative">
                  <div className="absolute -top-1 left-0 w-2 h-2 rounded-full bg-blue-500" />
                </div>
                <h3 className="text-base font-bold text-white mb-2">{step.title}</h3>
                <p className="text-xs sm:text-sm text-neutral-400 leading-relaxed">{step.description}</p>
              </StaggerItem>
            ))}
          </StaggerGroup>
        </div>
      </section>
      <Divider />
      <section className="py-24 border-b border-white/[0.05]">
        <div className="max-w-7xl mx-auto px-6">
          <Reveal className="mb-14">
            <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-2">
              Why Work With Us
            </span>
            <h2 className="text-3xl sm:text-4xl font-bold tracking-tight text-white">
              What that actually
              <br />
              means day to day.
            </h2>
          </Reveal>
          <StaggerGroup className="grid grid-cols-1 md:grid-cols-2 gap-6" stagger={0.1}>
            {principles.map((item) => (
              <StaggerItem key={item.index} className="hairline-card hairline-card-glow p-6 sm:p-7">
                <span className="text-xs font-mono text-blue-400 mb-3 block">{item.index}</span>
                <h3 className="text-base font-bold text-white mb-2">{item.title}</h3>
                <p className="text-xs sm:text-sm text-neutral-400 leading-relaxed">{item.description}</p>
              </StaggerItem>
            ))}
          </StaggerGroup>
        </div>
      </section>
      <Divider />
      <section className="py-24 border-b border-white/[0.05]" id="team">
        <div className="max-w-7xl mx-auto px-6">
          <Reveal className="mb-14">
            <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-2">
              Team
            </span>
            <h2 className="text-3xl sm:text-4xl font-bold tracking-tight text-white mb-3">
              Meet The Team Behind HiSkyTech.
            </h2>
            <p className="text-neutral-400 text-sm sm:text-base leading-relaxed max-w-xl">
              People, technology, and ideas working together to build digital solutions that matter.
            </p>
          </Reveal>
          <StaggerGroup className="grid grid-cols-2 lg:grid-cols-4 gap-6" stagger={0.1}>
            {team.map((member) => (
              <StaggerItem key={member.name}>
                <div className="hairline-card hairline-card-glow overflow-hidden group h-full flex flex-col">
                  <div className="aspect-[4/5] relative bg-white/[0.02] flex items-center justify-center overflow-hidden">
                    <Image
                      src={member.image}
                      alt={member.name}
                      fill
                      sizes="(min-width: 1024px) 25vw, 50vw"
                      className="object-cover transition-transform duration-500 group-hover:scale-[1.06]"
                    />
                  </div>
                  <div className="p-4 text-center border-t border-white/[0.05]">
                    <h3 className="text-sm font-bold text-white">{member.name}</h3>
                    <p className="text-xs text-blue-400 font-mono mt-1">{member.role}</p>
                  </div>
                </div>
              </StaggerItem>
            ))}
          </StaggerGroup>
        </div>
      </section>
      <Divider />
      <section className="py-24 border-b border-white/[0.05]">
        <div className="max-w-7xl mx-auto px-6 text-center">
          <Reveal>
            <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-2">
              Tech Stack
            </span>
            <h2 className="text-3xl sm:text-4xl font-bold tracking-tight text-white mb-10">
              Tools We Build With.
            </h2>
          </Reveal>
          <StaggerGroup
            className="flex flex-wrap items-center justify-center gap-2.5 max-w-4xl mx-auto"
            stagger={0.03}
          >
            {tools.map((tool) => (
              <StaggerItem key={tool}>
                <span className="badge-pill px-4 py-2 rounded-full text-xs font-mono text-neutral-300 inline-block">
                  {tool}
                </span>
              </StaggerItem>
            ))}
          </StaggerGroup>
        </div>
      </section>
      <Divider />
      <section className="py-20">
        <div className="max-w-7xl mx-auto px-6">
          <Reveal>
            <div className="hairline-card py-16 px-8 sm:px-14 text-center relative overflow-hidden bg-gradient-to-b from-neutral-900/60 to-[#09090e]">
              <p className="text-xl sm:text-2xl md:text-3xl font-semibold text-white tracking-tight max-w-2xl mx-auto leading-snug">
                Focused on building practical AI systems and digital experiences that create
                measurable value.
              </p>
            </div>
          </Reveal>
        </div>
      </section>
      <Divider />
      <section className="py-24 border-t border-white/[0.05] relative" id="contact">
        <div className="max-w-7xl mx-auto px-6">
          <div className="max-w-2xl">
            <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-3">
              Contact
            </span>
            <h2 className="text-3xl sm:text-5xl font-bold tracking-tight text-white mb-4">
              Have an Idea? Let&apos;s Build It.
            </h2>
            <p className="text-neutral-400 text-sm sm:text-base leading-relaxed mb-8">
              Tell us what you&apos;re trying to build, automate, or improve. We&apos;ll help turn it
              into a practical digital solution.
            </p>
            <div className="flex flex-wrap items-center gap-3 mb-8">
              <Link
                className="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-black font-semibold text-sm hover:bg-neutral-200 transition-all shadow-lg shadow-white/10"
                href="/contact/"
              >
                <span>Let&apos;s Talk Business</span>
                <span>→</span>
              </Link>
              <BookCallButton />
            </div>
            <ContactMethods />
            <div className="mt-10">
              <span className="text-[11px] uppercase font-mono tracking-wider text-neutral-500 block mb-3">
                Find Us Elsewhere
              </span>
              <SocialLinks />
              <a
                href="https://hiskytechs.com"
                target="_blank"
                rel="noopener noreferrer"
                className="inline-flex items-center gap-1.5 text-xs text-neutral-500 hover:text-white transition-colors mt-5"
              >
                Agency — hiskytechs.com <span>↗</span>
              </a>
            </div>
          </div>
        </div>
      </section>
    </main>
  );
}
