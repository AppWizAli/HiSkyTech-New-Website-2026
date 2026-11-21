"use client";

import { useEffect, useRef } from "react";
import { useInView, useMotionValue, useSpring } from "framer-motion";

/**
 * The visible number is the real target in the server HTML. The count-up
 * only rewrites the text after hydration, and only once the figure is in
 * view, so a browser with JavaScript disabled still shows the real count.
 */
export function Counter({
  target,
  suffix = "",
  className,
}: {
  target: number;
  suffix?: string;
  className?: string;
}) {
  const ref = useRef<HTMLSpanElement>(null);
  const inView = useInView(ref, { once: true, margin: "-40px" });
  const motionValue = useMotionValue(0);
  const spring = useSpring(motionValue, { damping: 30, stiffness: 100 });

  useEffect(() => {
    if (inView) motionValue.set(target);
  }, [inView, motionValue, target]);

  useEffect(() => {
    return spring.on("change", (value) => {
      if (!ref.current || !inView) return;
      ref.current.textContent = `${Math.round(value)}${suffix}`;
    });
  }, [spring, suffix, inView]);

  return (
    <span ref={ref} className={className}>
      {target}
      {suffix}
    </span>
  );
}
