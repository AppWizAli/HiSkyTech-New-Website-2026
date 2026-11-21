"use client";

import Image from "next/image";
import Link from "next/link";
import { motion } from "framer-motion";

const fadeUp = {
  hidden: { opacity: 0, y: 28 },
  visible: { opacity: 1, y: 0, transition: { duration: 0.6, ease: [0.16, 1, 0.3, 1] } },
};

export function Hero() {
  return (
    <section className="relative pt-20 pb-28 md:pt-32 md:pb-40 border-b border-white/[0.05] overflow-hidden bg-grid-pattern">
      <div className="absolute top-1/4 left-1/4 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none" />
      <div className="absolute top-1/3 right-10 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none" />
      <div className="max-w-7xl mx-auto px-6">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
          <motion.div
            className="lg:col-span-7 flex flex-col items-start space-y-6"
            initial="hidden"
            animate="visible"
            variants={{ visible: { transition: { staggerChildren: 0.08 } } }}
          >
            <motion.div
              variants={fadeUp}
              className="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium tracking-wide uppercase bg-white/[0.04] border border-white/[0.08] text-neutral-300"
            >
              <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse" />
              Building digital solutions for businesses
            </motion.div>
            <motion.h1
              variants={fadeUp}
              className="text-4xl sm:text-5xl md:text-6xl font-bold tracking-tight text-white leading-[1.12]"
            >
              We Build <br />
              Intelligent Digital <br />
              Experiences With <span className="text-blue-500">AI.</span>
            </motion.h1>
            <motion.p
              variants={fadeUp}
              className="text-xs sm:text-sm uppercase tracking-widest text-neutral-400 font-mono"
            >
              Software Development <span className="text-neutral-600">/</span> AI &amp; Automation{" "}
              <span className="text-neutral-600">/</span> Calling Agents{" "}
              <span className="text-neutral-600">/</span> Mobile Apps{" "}
              <span className="text-neutral-600">/</span> Websites
            </motion.p>
            <motion.p
              variants={fadeUp}
              className="text-neutral-400 text-sm sm:text-base leading-relaxed max-w-lg pt-1"
            >
              We help businesses automate repetitive workflows, build intelligent AI calling
              systems, and create modern apps and websites that turn ideas into real digital
              products.
            </motion.p>
            <motion.div variants={fadeUp} className="flex flex-wrap items-center gap-4 pt-2">
              <a
                className="px-6 py-3 rounded-full bg-white text-black font-semibold text-sm hover:bg-neutral-200 transition-all flex items-center gap-2 shadow-lg shadow-white/10"
                href="#work"
              >
                View Our Work <span>→</span>
              </a>
              <Link
                className="px-6 py-3 rounded-full bg-transparent hover:bg-white/[0.05] text-white font-medium text-sm border border-white/10 transition-all flex items-center gap-2"
                href="/contact/"
              >
                Let&apos;s Talk Business <span>→</span>
              </Link>
            </motion.div>
            <motion.div
              variants={fadeUp}
              className="pt-8 flex items-center gap-2 text-xs text-neutral-500"
            >
              <span>Scroll to explore</span>
              <svg className="w-3.5 h-3.5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  d="M19 14l-7 7m0 0l-7-7m7 7V3"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                />
              </svg>
            </motion.div>
          </motion.div>
          <motion.div
            className="lg:col-span-5 flex justify-center lg:justify-end relative"
            initial={{ opacity: 0, scale: 0.9 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 0.9, ease: [0.16, 1, 0.3, 1], delay: 0.3 }}
          >
            <div className="relative w-72 h-72 sm:w-96 sm:h-96 mb-6 rounded-2xl overflow-hidden border border-white/10 shadow-2xl">
              <Image
                src="/office.webp"
                alt="Inside the HiSkyTech office"
                fill
                sizes="(min-width: 640px) 384px, 288px"
                className="object-cover"
                priority
              />
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
