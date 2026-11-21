"use client";

import { useEffect, useState } from "react";
import Image from "next/image";
import Link from "next/link";
import { motion } from "framer-motion";
import { navLinks } from "@/lib/content";

function cn(...parts: Array<string | false | null | undefined>) {
  return parts.filter(Boolean).join(" ");
}

export function Header() {
  const [open, setOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const [active, setActive] = useState("");

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 8);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  useEffect(() => {
    const ids = navLinks.map((link) => link.href.replace("/#", ""));
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) setActive(entry.target.id);
        });
      },
      { rootMargin: "-45% 0px -50% 0px", threshold: 0 },
    );
    ids.forEach((id) => {
      const node = document.getElementById(id);
      if (node) observer.observe(node);
    });
    return () => observer.disconnect();
  }, []);

  useEffect(() => {
    document.body.style.overflow = open ? "hidden" : "";
    return () => {
      document.body.style.overflow = "";
    };
  }, [open]);

  return (
    <header
      className={cn(
        "sticky top-0 z-50 w-full backdrop-blur-md bg-brand-dark/80 border-b transition-colors duration-300",
        scrolled ? "border-white/[0.08]" : "border-white/[0.06]",
      )}
    >
      <div className="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <Link href="/" className="flex items-center gap-2 group">
          <Image
            src="/logo.webp"
            alt="HiSkyTech"
            width={1206}
            height={252}
            priority
            className="h-8 w-auto"
          />
        </Link>
        <nav className="hidden md:flex items-center space-x-8 text-sm text-neutral-400">
          {navLinks.map((link) => {
            const id = link.href.replace("/#", "");
            const current = active === id;
            return (
              <a
                key={link.href}
                href={link.href}
                className={cn(
                  "relative py-1 transition-colors duration-200 hover:text-white",
                  current && "text-white",
                )}
              >
                {link.label}
                {current && (
                  <motion.span
                    layoutId="nav-underline"
                    className="absolute left-0 right-0 -bottom-1 h-px bg-blue-500"
                    transition={{ type: "spring", stiffness: 380, damping: 32 }}
                  />
                )}
              </a>
            );
          })}
        </nav>
        <div className="flex items-center gap-3">
          <Link
            className="hidden sm:flex px-4 py-2 text-xs md:text-sm font-medium rounded-full bg-white/5 hover:bg-white/10 text-white border border-white/10 transition-all duration-200 items-center gap-2 group"
            href="/#contact"
          >
            <span>Let&apos;s Work Together</span>
            <span className="text-neutral-400 group-hover:translate-x-0.5 transition-transform">
              →
            </span>
          </Link>
          <button
            type="button"
            aria-label="Toggle navigation menu"
            aria-expanded={open}
            onClick={() => setOpen((value) => !value)}
            className="md:hidden relative w-9 h-9 flex items-center justify-center rounded-full border border-white/10 bg-white/5 text-white"
          >
            <span className="sr-only">Menu</span>
            <div className="relative w-4 h-3">
              <motion.span
                className="absolute left-0 top-0 w-4 h-px bg-white"
                animate={open ? { rotate: 45, y: 6 } : { rotate: 0, y: 0 }}
                transition={{ duration: 0.2 }}
              />
              <motion.span
                className="absolute left-0 top-1.5 w-4 h-px bg-white"
                animate={open ? { opacity: 0 } : { opacity: 1 }}
                transition={{ duration: 0.15 }}
              />
              <motion.span
                className="absolute left-0 top-3 w-4 h-px bg-white"
                animate={open ? { rotate: -45, y: -6 } : { rotate: 0, y: 0 }}
                transition={{ duration: 0.2 }}
              />
            </div>
          </button>
        </div>
      </div>
      {open && (
        <nav className="md:hidden border-t border-white/[0.06] bg-brand-dark/95 px-6 py-4 flex flex-col gap-3">
          {navLinks.map((link) => (
            <a
              key={link.href}
              href={link.href}
              onClick={() => setOpen(false)}
              className="text-sm text-neutral-300 hover:text-white py-2"
            >
              {link.label}
            </a>
          ))}
          <Link
            href="/contact/"
            onClick={() => setOpen(false)}
            className="mt-2 px-4 py-2 text-sm font-medium rounded-full bg-white text-black text-center"
          >
            Let&apos;s Talk Business
          </Link>
        </nav>
      )}
    </header>
  );
}
