"use client";

import { useMemo, useState } from "react";
import Image from "next/image";
import Link from "next/link";
import { motion } from "framer-motion";
import { projects, workFilters, type Project } from "@/lib/content";
import { Reveal } from "@/components/Reveal";

function cn(...parts: Array<string | false | null | undefined>) {
  return parts.filter(Boolean).join(" ");
}

function mshot(url: string, width = 1280, height = 720) {
  return `https://s.wordpress.com/mshots/v1/${encodeURIComponent(url)}?w=${width}&h=${height}`;
}

const accents: Record<NonNullable<Project["accent"]>, string> = {
  amber: "bg-gradient-to-br from-amber-900/30 to-neutral-900",
  emerald: "bg-gradient-to-br from-emerald-900/30 to-neutral-900",
  slate: "bg-gradient-to-br from-slate-800/40 to-neutral-900",
  rose: "bg-gradient-to-br from-rose-900/25 to-neutral-900",
  teal: "bg-gradient-to-br from-teal-900/30 to-neutral-900",
};

function VoiceSample({ script }: { script: string }) {
  const [playing, setPlaying] = useState(false);
  const supported = typeof window !== "undefined" && "speechSynthesis" in window;

  function toggle(event: React.MouseEvent) {
    event.preventDefault();
    event.stopPropagation();
    if (!supported) return;
    if (playing) {
      window.speechSynthesis.cancel();
      setPlaying(false);
      return;
    }
    window.speechSynthesis.cancel();
    const utterance = new SpeechSynthesisUtterance(script);
    utterance.rate = 1;
    utterance.pitch = 1;
    utterance.onend = () => setPlaying(false);
    utterance.onerror = () => setPlaying(false);
    window.speechSynthesis.speak(utterance);
    setPlaying(true);
  }

  return (
    <button
      type="button"
      onClick={toggle}
      aria-label={playing ? "Stop voice sample" : "Play voice sample"}
      className="w-12 h-12 rounded-full bg-white/10 border border-white/20 flex items-center justify-center group-hover:scale-110 transition-transform relative z-10"
    >
      {playing ? (
        <div className="flex items-center gap-0.5 h-4">
          <span className="w-1 bg-white h-2 animate-pulse" />
          <span className="w-1 bg-white h-4 animate-pulse [animation-delay:75ms]" />
          <span className="w-1 bg-white h-2.5 animate-pulse [animation-delay:150ms]" />
          <span className="w-1 bg-white h-3.5 animate-pulse [animation-delay:100ms]" />
        </div>
      ) : (
        <svg className="w-5 h-5 text-white fill-current ml-0.5" viewBox="0 0 24 24">
          <path d="M8 5v14l11-7z" />
        </svg>
      )}
    </button>
  );
}

function ProjectCard({ project }: { project: Project }) {
  return (
    <motion.article
      variants={{
        hidden: { opacity: 0, y: 28 },
        visible: { opacity: 1, y: 0, transition: { duration: 0.6, ease: [0.16, 1, 0.3, 1] } },
      }}
      className="hairline-card hairline-card-glow overflow-hidden group flex flex-col h-full"
    >
      {project.previewType === "voiceDemo" && project.image && project.demoScript && (
        <div className="aspect-video bg-[#111116] border-b border-white/10 relative overflow-hidden flex items-center justify-center">
          <Image
            src={project.image}
            alt={`${project.title} preview`}
            fill
            sizes="(min-width: 1024px) 33vw, (min-width: 768px) 50vw, 100vw"
            className="object-cover transition-transform duration-500 group-hover:scale-[1.06]"
          />
          <div className="absolute inset-0 bg-black/55" />
          <VoiceSample script={project.demoScript} />
          <div className="absolute bottom-0 inset-x-0 bg-[#08080b]/90 backdrop-blur-[2px] px-3 py-1.5 flex items-center justify-between gap-2">
            <span className="text-[10px] uppercase tracking-wider font-mono text-neutral-300">
              {project.previewLabel}
            </span>
            <span className="text-[9px] text-neutral-500 italic shrink-0">TTS sample</span>
          </div>
        </div>
      )}
      {project.previewType === "caseStudy" && (
        <div
          className={cn(
            "aspect-video border-b border-white/10 p-5 flex flex-col justify-center items-center text-center",
            accents[project.accent ?? "slate"],
          )}
        >
          <div className="text-lg font-extrabold text-white tracking-wide">{project.title}</div>
          <div className="text-[11px] text-neutral-300/80 mt-1.5 px-2 leading-relaxed">
            {project.previewLabel}
          </div>
        </div>
      )}
      {project.previewType === "screenshot" && project.href && (
        <div className="aspect-video bg-[#111116] border-b border-white/10 relative overflow-hidden">
          <Image
            src={mshot(project.href)}
            alt={`${project.title} website preview`}
            fill
            sizes="(min-width: 1024px) 33vw, (min-width: 768px) 50vw, 100vw"
            className="object-cover object-top transition-transform duration-500 group-hover:scale-[1.06]"
          />
          <div className="absolute bottom-0 inset-x-0 bg-[#08080b]/90 backdrop-blur-[2px] px-3 py-1.5">
            <span className="text-[10px] uppercase tracking-wider font-mono text-neutral-300">
              {project.previewLabel}
            </span>
          </div>
        </div>
      )}
      {project.previewType === "image" && project.image && (
        <div className="aspect-video bg-[#111116] border-b border-white/10 relative overflow-hidden">
          <Image
            src={project.image}
            alt={`${project.title} website preview`}
            fill
            sizes="(min-width: 1024px) 33vw, (min-width: 768px) 50vw, 100vw"
            className="object-cover object-top transition-transform duration-500 group-hover:scale-[1.06]"
          />
          <div className="absolute bottom-0 inset-x-0 bg-[#08080b]/90 backdrop-blur-[2px] px-3 py-1.5">
            <span className="text-[10px] uppercase tracking-wider font-mono text-neutral-300">
              {project.previewLabel}
            </span>
          </div>
        </div>
      )}
      <div className="p-5 flex flex-col justify-between flex-1">
        <div>
          <span className="text-[10px] uppercase font-mono tracking-wider text-blue-400 block mb-1">
            {project.category}
          </span>
          <h4 className="text-base font-bold text-white group-hover:text-blue-400 transition-colors mb-1">
            {project.title}
          </h4>
          {project.description && (
            <p className="text-xs text-neutral-400 mb-3 leading-relaxed">{project.description}</p>
          )}
          {project.tags && (
            <div className="flex flex-wrap gap-1.5 mb-4">
              {project.tags.map((tag) => (
                <span
                  key={tag}
                  className="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-neutral-400"
                >
                  {tag}
                </span>
              ))}
            </div>
          )}
        </div>
        {project.demo ? (
          <span className="text-xs font-medium text-neutral-500">Demo — no public link</span>
        ) : (
          project.href && (
            <a
              href={project.href}
              target="_blank"
              rel="noopener noreferrer"
              className="text-xs font-medium text-neutral-300 hover:text-white flex items-center gap-1"
            >
              Visit Site <span>→</span>
            </a>
          )
        )}
      </div>
    </motion.article>
  );
}

const leadTags = ["AI Automation", "Lead Gen", "Gmail AI"];

export function SelectedWork() {
  const [filter, setFilter] = useState<(typeof workFilters)[number]>("All Work");
  const visible = useMemo(
    () => (filter === "All Work" ? projects : projects.filter((item) => item.category === filter)),
    [filter],
  );

  return (
    <section className="py-24 border-b border-white/[0.05]" id="work">
      <div className="max-w-7xl mx-auto px-6">
        <Reveal className="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
          <div>
            <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-2">
              Selected Work
            </span>
            <h2 className="text-3xl sm:text-4xl font-bold tracking-tight text-white mb-2">
              A sample of what these
              <br />
              systems look like in practice.
            </h2>
            <p className="text-xs sm:text-sm text-neutral-400">
              A mix of live client projects and concept demos that outline how real case studies
              come together.
            </p>
          </div>
          <div className="flex flex-wrap items-center gap-2">
            {workFilters.map((item) => (
              <button
                key={item}
                type="button"
                onClick={() => setFilter(item)}
                className={cn(
                  "px-3 py-1.5 rounded-full text-xs font-medium transition-colors duration-200",
                  filter === item ? "bg-white text-black" : "badge-pill text-neutral-300",
                )}
              >
                {item}
              </button>
            ))}
          </div>
        </Reveal>

        <Reveal className="hairline-card p-6 sm:p-8 lg:p-10 mb-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div className="lg:col-span-7 bg-[#06060a] border border-white/10 rounded-xl p-5 sm:p-6 relative overflow-hidden">
            <div className="flex items-center justify-between border-b border-white/10 pb-3 mb-5">
              <span className="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-indigo-500/15 text-indigo-300 border border-indigo-400/30">
                Featured
              </span>
              <span className="text-[11px] font-mono text-emerald-400 flex items-center gap-1">
                ● Active System
              </span>
            </div>
            <div className="relative w-full aspect-[16/9] rounded-lg overflow-hidden border border-white/10 bg-[#1a1a1a]">
              <Image
                src="/projects/lead-gen-workflow.png"
                alt="Real n8n automation workflow behind the AI lead generation and outreach system"
                fill
                sizes="(min-width: 1024px) 60vw, 100vw"
                className="object-contain"
              />
            </div>
          </div>
          <div className="lg:col-span-5 flex flex-col justify-center">
            <span className="text-xs uppercase font-mono tracking-widest text-blue-400 mb-2">
              AI Automation
            </span>
            <h3 className="text-2xl font-bold text-white mb-3">AI Lead Generation &amp; Outreach</h3>
            <p className="text-neutral-400 text-xs sm:text-sm leading-relaxed mb-6">
              User enters a query like &quot;Real Estate agents in Texas&quot; and the system scrapes
              matching leads, generates a personalized email for each one, and sends them out
              automatically. Every result is logged to Google Sheets. Replies are handled by AI in a
              natural, human-like tone, and leads who don&apos;t respond get automatic,
              human-sounding follow-ups.
            </p>
            <div className="flex flex-wrap gap-2 mb-6">
              {leadTags.map((tag) => (
                <span
                  key={tag}
                  className="text-[11px] font-mono px-2.5 py-1 rounded bg-white/[0.04] border border-white/10 text-neutral-300"
                >
                  {tag}
                </span>
              ))}
            </div>
            <Link
              className="text-xs font-medium text-white flex items-center gap-1 hover:text-blue-400 transition-colors"
              href="/#contact"
            >
              <span>View Case Study Outline</span>
              <span>→</span>
            </Link>
          </div>
        </Reveal>

        {visible.length > 0 ? (
          <motion.div
            key={filter}
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
            initial="hidden"
            animate="visible"
            variants={{ visible: { transition: { staggerChildren: 0.06 } } }}
          >
            {visible.map((project) => (
              <ProjectCard key={project.id} project={project} />
            ))}
          </motion.div>
        ) : (
          <p className="text-center py-16 text-sm text-neutral-500">
            More case studies in this category are on the way.
          </p>
        )}
      </div>
    </section>
  );
}
